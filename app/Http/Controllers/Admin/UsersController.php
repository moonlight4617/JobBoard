<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPictures;
use App\Models\Tag;
use App\Models\TagToUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;



class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at')->paginate(50);
        // dd($companies);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::where('subject', '=', '0')->get();
        return view('admin.user.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'intro' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
            'career' => ['nullable', 'string'],
            'hobby' => ['nullable', 'string'],
            'pro_image' => ['nullable', 'file', 'max:1024'],
            'portfolio1' => ['nullable', 'file', 'max:1024'],
        ]);

        // dd($request);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'catch' => $request->catch,
            'intro' => $request->intro,
            'license' => $request->license,
            'career' => $request->career,
            'hobby' => $request->hobby
        ]);

        // タグ登録
        if ($request->tags) {
            foreach ($request->tags as $tag) {
                TagToUser::create(['users_id' => $user->id, 'tags_id' => $tag]);
            }
        }

        // プロフィール画像登録
        // dd($request);
        if ($request->pro_image) {
            $imageFile = $request->pro_image;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.'  . $extension;
            $resizedImage = InterventionImage::make($imageFile)->orientate()->fit(1920, 1080)->encode();
            Storage::put('public/users/' . $fileNameToStore, $resizedImage);
        } else {
            $fileNameToStore1 = null;
        }
        $user->save();

        // ポートフォリオ画像登録
        if ($request->portfolio1) {
            $imagePortfolio = $request->portfolio1;
            $portfolioName = uniqid(rand() . '_');
            $extension = $imagePortfolio->extension();
            $portfolioToStore = $portfolioName . '.'  . $extension;
            $resizedPortfolio = InterventionImage::make($imagePortfolio)->orientate()->fit(200, 200)->encode();
            Storage::put('public/users/portfolio/' . $portfolioToStore, $resizedPortfolio);

            // 新たにUserPicturesに画像登録
            UserPictures::create(['users_id' => $user->id, 'filename' => $portfolioToStore]);
        }

        return redirect()->route('admin.users.show', compact('user'))->with(['message' => 'ユーザー情報を登録しました。', 'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $tags = $user->Tags;
        $pictures = UserPictures::where('users_id', '=', $id)->get();
        return view('admin.user.show', compact('user', 'tags', 'pictures'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $pictures = UserPictures::where('users_id', '=', $id)->get();
        $tags = Tag::where('subject', '=', '0')->get();
        $userTags = $user->Tags;

        return view('admin.user.edit', compact('user', 'pictures', 'tags', 'userTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadImageRequest $request, $id)
    {
        // dd($request);
        $request->validate([
            'catch' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
            'career' => ['nullable', 'string'],
            'hobby' => ['nullable', 'string'],
            // 'tag' => ['nullable', 'string'],
            // 'pro_image' => ['nullable', 'file', 'max:1024'],
            'tag' => Rule::unique('users')->where(function ($query) {
                return $query->where('account_id', 1);
            })
        ]);

        $user = User::findOrFail($id);

        // 画像が既に登録ずみであれば削除
        if ($request->pro_image) {
            $filePath = 'public/users/' . $user->pro_image;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
            // 改めて画像登録
            $imageFile = $request->pro_image;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore = $fileName . '.'  . $extension;
            $resizedImage = InterventionImage::make($imageFile)->orientate()->fit(1920, 1080)->encode();
            Storage::put('public/users/' . $fileNameToStore, $resizedImage);
            $user->pro_image = $fileNameToStore;
        }

        if ($request->tag) {
            $userTags = TagToUser::where('users_id', $id)->get();
            foreach ($request->tag as $tag) {
                if ($userTags && !$userTags->contains($tag)) {
                    dd($request->tag, $userTags);
                    TagToUser::create(['users_id' => $id, 'tags_id' => $tag]);
                }
            }
        }

        if ($request->portfolio) {
            foreach ($request->portfolio as $userPic) {
                // storageに画像登録
                $userPicName = uniqid(rand() . '_');
                $extension = $userPic->extension();
                $userPicNameToStore = $userPicName . '.'  . $extension;
                $resizedUserPic = InterventionImage::make($userPic)->orientate()->fit(200, 200)->encode();
                Storage::put('public/users/portfolio/' . $userPicNameToStore, $resizedUserPic);

                // UserPicturesに画像登録
                UserPictures::create(['users_id' => $id, 'filename' => $userPicNameToStore]);
            }
        }

        $user->catch = $request->catch;
        $user->intro = $request->intro;
        $user->license = $request->license;
        $user->career = $request->career;
        $user->hobby = $request->hobby;
        $user->save();

        return redirect()->route('admin.users.show', compact('user'))->with(['message' => '更新しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.companies.index')->with(['message' => '企業を削除しました。', 'status' => 'alert']);
    }
}

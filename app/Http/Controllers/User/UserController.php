<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPictures;
use App\Models\Tag;
use App\Models\TagToUser;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');

        // $this->middleware(function ($request, $next) {
        //     $id = $request->route()->parameter('user');
        //     if (!is_null($id)) {
        //         $userId = User::findOrFail($id)->id;
        //         if ($userId !== Auth::id()) {
        //             abort(404); // 404画面表示 }
        //         }
        //         return $next($request);
        //     }
        // });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.mypage.create');
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
            'catch' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'license' => ['nullable', 'string'],
            'career' => ['nullable', 'string'],
            'hobby' => ['nullable', 'string'],
            'pro_image' => ['nullable', 'file', 'max:1024'],
            'portfolio1' => ['nullable', 'file', 'max:1024'],
        ]);

        $user = User::findOrFail(Auth::id());
        $user->catch = $request->catch;
        $user->intro = $request->intro;
        $user->license = $request->license;
        $user->career = $request->career;
        $user->hobby = $request->hobby;

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


        return redirect()->route('user.user.show', compact('user'))->with(['message' => 'ユーザー情報を登録しました。', 'status' => 'info']);
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
        $pictures = UserPictures::where('users_id', '=', $id)->get();
        return view('user.mypage.show', compact('user', 'pictures'));
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
        return view('user.mypage.edit', compact('user', 'pictures', 'tags'));
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
            // 'pro_image' => ['nullable', 'file', 'max:1024'],
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
            foreach ($request->tag as $tag) {
                TagToUser::create(['users_id' => $id, 'tags_id' => $tag]);
            }
        }

        if ($request->portfolio) {
            // 画像削除の際
            // $portfolioPath = 'public/users/portfolio' . $user->portfolio1;
            // if (Storage::exists($portfolioPath)) {
            //     Storage::delete($portfolioPath);
            // }

            foreach ($request->portfolio as $userPic) {
                // 改めてstorageに画像登録
                // $imagePortfolio = $request->portfolio1;
                $userPicName = uniqid(rand() . '_');
                $extension = $userPic->extension();
                $userPicNameToStore = $userPicName . '.'  . $extension;
                $resizedUserPic = InterventionImage::make($userPic)->orientate()->fit(200, 200)->encode();
                Storage::put('public/users/portfolio/' . $userPicNameToStore, $resizedUserPic);

                // 新たにUserPicturesに画像登録
                UserPictures::create(['users_id' => $id, 'filename' => $userPicNameToStore]);
            }
        }

        $user->catch = $request->catch;
        $user->intro = $request->intro;
        $user->license = $request->license;
        $user->career = $request->career;
        $user->hobby = $request->hobby;
        $user->save();

        return redirect()->route('user.user.show', compact('user'))->with(['message' => '更新しました。', 'status' => 'info']);
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
        return redirect()->route('user.register')->with(['message' => 'ユーザー情報を削除しました。', 'status' => 'alert']);
    }


    public function pictureAdd(UploadImageRequest $request)
    {
        $imagePortfolio = $request->portfolio;
        $portfolioName = uniqid(rand() . '_');
        $extension = $imagePortfolio->extension();
        $portfolioToStore = $portfolioName . '.'  . $extension;
        $resizedPortfolio = InterventionImage::make($imagePortfolio)->orientate()->fit(200, 200)->encode();
        Storage::put('public/users/portfolio/' . $portfolioToStore, $resizedPortfolio);

        // 新たにUserPicturesに画像登録
        UserPictures::create(['users_id' => Auth::id(), 'filename' => $portfolioToStore]);
        return;
    }

    public function pictureDestroy(Request $request)
    {
        $picture_id = $request->pic_id;
        $picture = UserPictures::findOrFail($picture_id);
        $filePath = 'public/users/portfolio/' . $picture->filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        $picture->delete();
        return;
    }
}

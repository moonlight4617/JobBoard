<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\InterventionImage;
use Illuminate\Support\Facades\Storage;


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
            'intro' => ['required', 'string'],
            'image1' => ['nullable', 'file', 'size:1024'],
            'image2' => ['nullable', 'file', 'size:1024'],
            'image3' => ['nullable', 'file', 'size:1024'],
            'tel' => ['nullable', 'string'],
            'post_code' => ['nullable', 'integer'],
            'address' => ['nullable', 'string', 'max:255'],
            'homepage' => ['nullable', 'string', 'max:255']
        ]);

        $company = Companies::findOrFail(Auth::id());
        $company->intro = $request->intro;
        $company->tel = $request->tel;
        $company->post_code = $request->post_code;
        $company->address = $request->address;
        $company->homepage = $request->homepage;

        // dd($request);
        // image1,2,3がparamsにあれば、一旦削除した後に、登録
        if ($request->imgpath1) {
            $imageFile = $request->imgpath1;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore1 = $fileName . '.'  . $extension;
            $resizedImage1 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/companies/' . $fileNameToStore1, $resizedImage1);
        } else {
            $fileNameToStore1 = null;
        }
        if ($request->imgpath2) {
            $imageFile = $request->imgpath2;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore2 = $fileName . '.'  . $extension;
            $resizedImage2 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/companies/' . $fileNameToStore2, $resizedImage2);
        } else {
            $fileNameToStore2 = null;
        }
        if ($request->imgpath3) {
            $imageFile = $request->imgpath3;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore3 = $fileName . '.'  . $extension;
            $resizedImage3 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/companies/' . $fileNameToStore3, $resizedImage3);
        } else {
            $fileNameToStore3 = null;
        }

        $company->save();

        return redirect()->route('company.company.show', compact('company'))->with(['message' => '登録しました。', 'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Companies::findOrFail($id);
        return view('company.mypage.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::findOrFail($id);
        return view('company.mypage.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'intro' => ['required', 'string'],
            'image1' => ['nullable', 'file', 'size:1024'],
            'image2' => ['nullable', 'file', 'size:1024'],
            'image3' => ['nullable', 'file', 'size:1024'],
            'tel' => ['nullable', 'string'],
            'post_code' => ['nullable', 'integer'],
            'address' => ['nullable', 'string', 'max:255'],
            'homepage' => ['nullable', 'string', 'max:255']
        ]);

        // dd($request);
        // image1,2,3がparamsにあれば、一旦削除した後に、登録
        if ($request->imgpath1) {
            // 画像が既に登録ずみであれば削除
            $filePath1 = 'public/companies/' . $company->image1;
            if (Storage::exists($filePath1)) {
                Storage::delete($filePath1);
            }
            // 改めて画像登録
            $imageFile = $request->imgpath1;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore1 = $fileName . '.'  . $extension;
            $resizedImage1 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/companies/' . $fileNameToStore1, $resizedImage1);
        } else {
            $fileNameToStore1 = null;
        }
        if ($request->imgpath2) {
            // 画像が既に登録ずみであれば削除
            $filePath2 = 'public/companies/' . $company->image2;
            if (Storage::exists($filePath2)) {
                Storage::delete($filePath2);
            }
            // 改めて画像登録
            $imageFile = $request->imgpath2;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore2 = $fileName . '.'  . $extension;
            $resizedImage2 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/companies/' . $fileNameToStore2, $resizedImage2);
        } else {
            $fileNameToStore2 = null;
        }
        if ($request->imgpath3) {
            // 画像が既に登録ずみであれば削除
            $filePath3 = 'public/companies/' . $company->image3;
            if (Storage::exists($filePath3)) {
                Storage::delete($filePath3);
            }
            // 改めて画像登録
            $imageFile = $request->imgpath3;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore3 = $fileName . '.'  . $extension;
            $resizedImage3 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/companies/' . $fileNameToStore3, $resizedImage3);
        } else {
            $fileNameToStore3 = null;
        }

        $company = Companies::findOrFail($id);
        $company->name = $request->name;
        $company->intro = $request->intro;
        $company->tel = $request->tel;
        $company->post_code = $request->post_code;
        $company->address = $request->address;
        $company->homepage = $request->homepage;
        $company->image1 = $fileNameToStore1;
        $company->image2 = $fileNameToStore2;
        $company->image3 = $fileNameToStore3;

        $company->save();

        return redirect()->route('company.company.show', compact('company'))->with(['message' => '更新しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Companies::findOrFail($id)->delete();
        return redirect()->route('company.register')->with(['message' => '企業情報を削除しました。', 'status' => 'alert']);
    }
}

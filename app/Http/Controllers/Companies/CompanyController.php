<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Models\Jobs;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:companies');
    }

    public function create()
    {
        return view('company.mypage.create');
    }

    public function store(UploadImageRequest $request)
    {
        $request->validate([
            'intro' => ['required', 'string'],
            // 'image1' => ['nullable', 'file', 'max:1024'],
            // 'image2' => ['nullable', 'file', 'max:1024'],
            // 'image3' => ['nullable', 'file', 'max:1024'],
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

        $company->image1 = $fileNameToStore1;
        $company->image2 = $fileNameToStore2;
        $company->image3 = $fileNameToStore3;

        $company->save();

        return redirect()->route('company.company.show', compact('company'))->with(['message' => '登録しました。', 'status' => 'info']);
    }

    public function show(Request $request, $id)
    {
        $company = Companies::findOrFail($id);
        return view('company.mypage.show', compact('company'));
    }

    public function edit($id)
    {
        $company = Companies::findOrFail($id);
        return view('company.mypage.edit', compact('company'));
    }

    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'intro' => ['required', 'string'],
            // 'image1' => ['nullable', 'file', 'max:1024'],
            // 'image2' => ['nullable', 'file', 'max:1024'],
            // 'image3' => ['nullable', 'file', 'max:1024'],
            'tel' => ['nullable', 'string'],
            'post_code' => ['nullable', 'integer'],
            'address' => ['nullable', 'string', 'max:255'],
            'homepage' => ['nullable', 'string', 'max:255']
        ]);

        $company = Companies::findOrFail($id);

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
            $company->image1 = $fileNameToStore1;
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
            $company->image2 = $fileNameToStore2;
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
            $company->image3 = $fileNameToStore3;
        }

        $company->name = $request->name;
        $company->intro = $request->intro;
        $company->tel = $request->tel;
        $company->post_code = $request->post_code;
        $company->address = $request->address;
        $company->homepage = $request->homepage;

        $company->save();

        return redirect()->route('company.company.show', compact('company'))->with(['message' => '更新しました。', 'status' => 'info']);
    }

    public function destroy($id)
    {
        Companies::findOrFail($id)->delete();
        return redirect()->route('company.register')->with(['message' => '企業情報を削除しました。', 'status' => 'alert']);
    }
}

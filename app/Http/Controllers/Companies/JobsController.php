<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:companies');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('job'); //jobのid取得
            if (!is_null($id)) {
                $jobCompanyId = Jobs::findOrFail($id)->companies->id;
                $jobId = (int)$jobCompanyId; // キャスト 文字列→数値に型変換
                $companyId = Auth::id();
                if ($jobId !== $companyId) {
                    abort(404); // 404画面表示 }
                }

                return $next($request);
            }
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::where('companies_id', Auth::id())->get();
        return view('company.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        // dd($request);
        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['nullable', 'string', 'max:255'],
            'duty_hours' => ['nullable', 'string', 'max:255'],
            'low_salary' => ['nullable', 'integer'],
            'high_salary' => ['nullable', 'integer'],
            'holiday' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:255'],
            // 'image1' => ['nullable', 'file', 'size:1024'],
            // 'image2' => ['nullable', 'file', 'size:1024'],
            // 'image3' => ['nullable', 'file', 'size:1024']
        ]);

        if ($request->imgpath1) {
            $imageFile = $request->imgpath1;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore1 = $fileName . '.'  . $extension;
            $resizedImage1 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore1, $resizedImage1);
        } else {
            $fileNameToStore1 = null;
        }
        if ($request->imgpath2) {
            $imageFile = $request->imgpath2;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore2 = $fileName . '.'  . $extension;
            $resizedImage2 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore2, $resizedImage2);
        } else {
            $fileNameToStore2 = null;
        }
        if ($request->imgpath3) {
            $imageFile = $request->imgpath3;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore3 = $fileName . '.'  . $extension;
            $resizedImage3 = InterventionImage::make($imageFile)->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore3, $resizedImage3);
        } else {
            $fileNameToStore3 = null;
        }

        Jobs::create([
            'companies_id' => Auth::id(),
            'job_name' => $request->job_name,
            'detail' => $request->detail,
            'conditions' => $request->conditions,
            'duty_hours' => $request->duty_hours,
            'low_salary' => $request->low_salary,
            'high_salary' => $request->high_salary,
            'holiday' => $request->holiday,
            'benefits' => $request->benefits,
            'image1' => $fileNameToStore1,
            'image2' => $fileNameToStore2,
            'image3' => $fileNameToStore3,
        ]);


        return redirect()->route('company.jobs.index')->with(['message' => '求人登録しました。', 'status' => 'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Jobs::findOrFail($id);
        return view('company.job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Jobs::findOrFail($id);
        return view('company.job.edit', compact('job'));
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
        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['nullable', 'string', 'max:255'],
            'duty_hours' => ['nullable', 'string', 'max:255'],
            'low_salary' => ['nullable', 'integer'],
            'high_salary' => ['nullable', 'integer'],
            'holiday' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:255'],
            // 'image1' => ['nullable', 'file', 'size:1024'],
            // 'image2' => ['nullable', 'file', 'size:1024'],
            // 'image3' => ['nullable', 'file', 'size:1024']
        ]);

        $job = Jobs::findOrFail($id);
        $job->job_name = $request->job_name;
        $job->detail = $request->detail;
        $job->conditions = $request->conditions;
        $job->duty_hours = $request->duty_hours;
        $job->low_salary = $request->low_salary;
        $job->high_salary = $request->high_salary;
        $job->holiday = $request->holiday;
        $job->benefits = $request->benefits;

        // dd($request);
        // image1,2,3がparamsにあれば、一旦削除した後に、登録

        if ($request->imgpath1) {
            $filePath1 = 'public/jobs/' . $job->image1;
            if (Storage::exists($filePath1)) {
                Storage::delete($filePath1);
            }
            $imageFile1 = $request->imgpath1;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile1->extension();
            $fileNameToStore1 = $fileName . '.'  . $extension;
            $resizedImage1 = InterventionImage::make($imageFile1)->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore1, $resizedImage1);
            $job->image1 = $fileNameToStore1;
        }
        if ($request->imgpath2) {
            $filePath2 = 'public/jobs/' . $job->image2;
            if (Storage::exists($filePath2)) {
                Storage::delete($filePath2);
            }
            $imageFile2 = $request->imgpath2;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile2->extension();
            $fileNameToStore2 = $fileName . '.'  . $extension;
            $resizedImage2 = InterventionImage::make($imageFile2)->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore2, $resizedImage2);
            $job->image2 = $fileNameToStore2;
        }
        if ($request->imgpath3) {
            $filePath3 = 'public/jobs/' . $job->image3;
            if (Storage::exists($filePath3)) {
                Storage::delete($filePath3);
            }
            $imageFile3 = $request->imgpath3;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile3->extension();
            $fileNameToStore3 = $fileName . '.'  . $extension;
            $resizedImage3 = InterventionImage::make($imageFile3)->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore3, $resizedImage3);
            $job->image3 = $fileNameToStore3;
        }

        $job->save();

        return redirect()->route('company.jobs.show', compact('job'))->with(['message' => '求人更新しました。', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jobs::findOrFail($id)->delete();
        return redirect()->route('company.jobs.index')->with(['message' => '求人を削除しました。', 'status' => 'alert']);
    }
}

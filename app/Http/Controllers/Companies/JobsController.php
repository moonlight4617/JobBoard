<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Tag;
use App\Models\TagToJob;
use App\Models\AppStatus;
use App\Models\Prefecture;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use InterventionImage;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadImageRequest;
use App\Enums\EmpStatus;
use BenSampo\Enum\Rules\Enum;

class JobsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:companies');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::where('companies_id', Auth::id())->with('tags')->with('Prefectures')->get();
        return view('company.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::where('subject', '=', '1')->get();
        $prefectures = Prefecture::all();
        $occupations = Occupation::all();
        $emp_statuses = EmpStatus::asSelectArray();
        return view('company.job.create', compact(['tags', 'emp_statuses', 'prefectures', 'occupations']));
    }

    /**
     * Store a newly created resource in storage. 
     */
    public function store(UploadImageRequest $request)
    {
        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'catch' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['nullable', 'string', 'max:255'],
            'duty_hours' => ['nullable', 'string', 'max:255'],
            'low_salary' => ['nullable', 'integer'],
            'high_salary' => ['nullable', 'integer'],
            'holiday' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:255'],
        ]);

        // タグのバリデーション
        $tags = $request->tag;
        if ($tags) {
            $correctTags = Tag::where('subject', 1)->pluck("id");
            foreach ($tags as $tag) {
                if (!$correctTags->contains($tag)) {
                    return redirect()
                        ->route('company.jobs.create')
                        ->withErrors("特徴タグで不正な値が選択されています")
                        ->withInput();
                }
            }
        }
        // 雇用形態のバリデーション
        $emp_status = intval($request->emp_status);
        if (!EmpStatus::hasValue($emp_status)) {
            return redirect()
                ->route('company.jobs.create')
                ->withErrors("雇用形態で不正な値が選択されています")
                ->withInput();
        }
        // 勤務地のバリデーション
        $prefectures = $request->prefecture;
        if ($prefectures) {
            $correctPrefectures = Prefecture::all()->pluck("id");
            foreach ($prefectures as $prefecture) {
                if (!$correctPrefectures->contains($prefecture)) {
                    return redirect()
                        ->route('company.jobs.create')
                        ->withErrors("勤務地で不正な値が選択されています")
                        ->withInput();
                }
            }
        }
        // 職種のバリデーション
        $occupations = $request->occupation;
        if ($occupations) {
            $correctOccupations = Occupation::all()->pluck("id");
            foreach ($occupations as $occupation) {
                if (!$correctOccupations->contains($occupation)) {
                    return redirect()
                        ->route('company.jobs.create')
                        ->withErrors("職種で不正な値が選択されています")
                        ->withInput();
                }
            }
        }

        if ($request->imgpath1) {
            $imageFile = $request->imgpath1;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore1 = $fileName . '.'  . $extension;
            $resizedImage1 = InterventionImage::make($imageFile)->orientate()->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore1, $resizedImage1);
        } else {
            $fileNameToStore1 = null;
        }
        if ($request->imgpath2) {
            $imageFile = $request->imgpath2;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore2 = $fileName . '.'  . $extension;
            $resizedImage2 = InterventionImage::make($imageFile)->orientate()->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore2, $resizedImage2);
        } else {
            $fileNameToStore2 = null;
        }
        if ($request->imgpath3) {
            $imageFile = $request->imgpath3;
            $fileName = uniqid(rand() . '_');
            $extension = $imageFile->extension();
            $fileNameToStore3 = $fileName . '.'  . $extension;
            $resizedImage3 = InterventionImage::make($imageFile)->orientate()->fit(1920, 1080)->encode();
            Storage::put('public/jobs/' . $fileNameToStore3, $resizedImage3);
        } else {
            $fileNameToStore3 = null;
        }

        $job = Jobs::create([
            'companies_id' => Auth::id(),
            'job_name' => $request->job_name,
            'catch' => $request->catch,
            'emp_status' => $emp_status,
            'detail' => $request->detail,
            'conditions' => $request->conditions,
            'duty_hours' => $request->duty_hours,
            'low_salary' => $request->low_salary,
            'high_salary' => $request->high_salary,
            'holiday' => $request->holiday,
            'benefits' => $request->benefits,
            'rec_status' => 0,
            'image1' => $fileNameToStore1,
            'image2' => $fileNameToStore2,
            'image3' => $fileNameToStore3,
        ]);

        if ($request->tag) {
            foreach ($request->tag as $tag) {
                $job->Tags()->attach($tag);
            }
        }

        if ($prefectures) {
            foreach ($prefectures as $prefecture) {
                $job->Prefectures()->attach($prefecture);
            }
        }

        if ($occupations) {
            foreach ($occupations as $occupation) {
                $job->occupations()->attach($occupation);
            }
        }

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
        $tags = Tag::where('subject', '=', '1')->get();
        $jobTags = $job->Tags;
        $prefectures = Prefecture::all();
        $jobPrefs = $job->Prefectures->pluck("id");
        $occupations = Occupation::all();
        $jobOccus = $job->occupations->pluck("id");
        $emp_statuses = EmpStatus::asSelectArray();
        return view('company.job.edit', compact(['job', 'tags', 'jobTags', 'emp_statuses', 'prefectures', 'jobPrefs', 'occupations', 'jobOccus']));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'job_name' => ['required', 'string', 'max:255'],
            'catch' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'string'],
            'conditions' => ['nullable', 'string', 'max:255'],
            'duty_hours' => ['nullable', 'string', 'max:255'],
            'low_salary' => ['nullable', 'integer'],
            'high_salary' => ['nullable', 'integer'],
            'holiday' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'string', 'max:255'],
        ]);

        // タグのバリデーション
        $tags = $request->tag;
        if ($tags) {
            $correctTags = Tag::where('subject', 1)->pluck("id");
            foreach ($tags as $tag) {
                if (!$correctTags->contains($tag)) {
                    return redirect()
                        ->route('company.jobs.create')
                        ->withErrors("特徴タグで不正な値が選択されています")
                        ->withInput();
                }
            }
        }
        // 雇用形態のバリデーション
        $emp_status = intval($request->emp_status);
        if (!EmpStatus::hasValue($emp_status)) {
            return redirect()
                ->route('company.jobs.create')
                ->withErrors("雇用形態で不正な値が選択されています")
                ->withInput();
        }
        // 勤務地のバリデーション
        $prefectures = $request->prefecture;
        if ($prefectures) {
            $correctPrefectures = Prefecture::all()->pluck("id");
            foreach ($prefectures as $prefecture) {
                if (!$correctPrefectures->contains($prefecture)) {
                    return redirect()
                        ->route('company.jobs.edit', ['job' => $id])
                        ->withErrors("勤務地で不正な値が選択されています")
                        ->withInput();
                }
            }
        }
        // 職種のバリデーション
        $occupations = $request->occupation;
        if ($occupations) {
            $correctOccupations = Occupation::all()->pluck("id");
            foreach ($occupations as $occupation) {
                if (!$correctOccupations->contains($occupation)) {
                    return redirect()
                        ->route('company.jobs.create')
                        ->withErrors("職種で不正な値が選択されています")
                        ->withInput();
                }
            }
        }

        $job = Jobs::findOrFail($id);
        $job->job_name = $request->job_name;
        $job->catch = $request->catch;
        $job->emp_status = $emp_status;
        $job->detail = $request->detail;
        $job->conditions = $request->conditions;
        $job->duty_hours = $request->duty_hours;
        $job->low_salary = $request->low_salary;
        $job->high_salary = $request->high_salary;
        $job->holiday = $request->holiday;
        $job->benefits = $request->benefits;

        // 条件分岐してタグを紐付け
        $jobTags = $job->Tags->pluck('id');
        if ($tags && $jobTags) {
            foreach ($tags as $tag) {
                if (!$jobTags->contains($tag)) {
                    $job->Tags()->attach($tag);
                }
            }
            foreach ($jobTags as $jobTag) {
                if (!in_array($jobTag, $tags)) {
                    $job->Tags()->detach($jobTag);
                }
            }
        } elseif ($tags) {
            foreach ($tags as $tag) {
                $job->Tags()->attach($tag);
            }
        } elseif ($jobTags) {
            $job->Tags()->detach();
        }

        // 条件分岐して勤務地を紐付け
        $jobPrefs = $job->Prefectures->pluck('id');
        if ($prefectures && $jobPrefs) {
            foreach ($jobPrefs as $jobPref) {
                if (!in_array($jobPref, $prefectures)) {
                    $job->Prefectures()->detach($jobPref);
                }
            }
            foreach ($prefectures as $pref) {
                if (!$jobPrefs->contains($pref)) {
                    $job->Prefectures()->attach($pref);
                }
            }
        } elseif ($prefectures) {
            foreach ($prefectures as $pref) {
                $job->Prefectures()->attach($pref);
            }
        } elseif ($jobPrefs) {
            $job->Prefectures()->detach();
        }

        // 条件分岐して職種を紐付け
        $jobOccus = $job->occupations->pluck('id');
        if ($occupations && $jobOccus) {
            foreach ($jobOccus as $jobOccu) {
                if (!in_array($jobOccu, $occupations)) {
                    $job->occupations()->detach($jobOccu);
                }
            }
            foreach ($occupations as $occu) {
                if (!$jobOccus->contains($occu)) {
                    $job->occupations()->attach($occu);
                }
            }
        } elseif ($occupations) {
            foreach ($occupations as $occu) {
                $job->occupations()->attach($occu);
            }
        } elseif ($jobOccus) {
            $job->occupations()->detach();
        }

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
            $resizedImage1 = InterventionImage::make($imageFile1)->orientate()->fit(1920, 1080)->encode();
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
            $resizedImage2 = InterventionImage::make($imageFile2)->orientate()->fit(1920, 1080)->encode();
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
            $resizedImage3 = InterventionImage::make($imageFile3)->orientate()->fit(1920, 1080)->encode();
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

    public function appliedIndex($id)
    {
        $usersId = AppStatus::where('jobs_id', $id)->where('app_flag', 1)->pluck('users_id');
        $users = User::whereIn('id', $usersId)->get();
        return view('company.job.appliedIndex', compact('users'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobs;
use App\Models\Prefecture;
use App\Models\Occupation;
use App\Models\Tag;


class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $jobs = Jobs::where('rec_status', 0)->paginate(50);
        $prefectures = Prefecture::all();
        $occupations = Occupation::all();
        $tags = Tag::where('subject', 1)->get();
        return view('admin.job.index', compact(['jobs', 'prefectures', 'occupations', 'tags']));
    }

    public function show($id)
    {
        $job = Jobs::findOrFail($id);
        return view('admin.job.show', compact('job'));
    }

    public function query(Request $request)
    {
        $requestPrefs = $request->prefectures;
        $requestOccupations = $request->occupations;
        $requestLowSalary = $request->low_salary;
        // $requestHighSalary = $request->high_salary;
        $requestTags = $request->tags;
        $requestSearch = $request->search;
        // dd($requestSearch);

        $jobs = Jobs::where('rec_status', 0)
            ->when($requestPrefs, function ($query, $requestPrefs) {
                return $query->leftJoin('job_locations', 'jobs.id', '=', 'job_locations.jobs_id')
                    ->whereIn('job_locations.prefectures_id', $requestPrefs);
            })
            ->when($requestOccupations, function ($query, $requestOccupations) {
                return $query->leftJoin('job_occupations', 'jobs.id', '=', 'job_occupations.jobs_id')
                    ->whereIn('job_occupations.occupations_id', $requestOccupations);
            })
            // 条件変更。上限廃止、下限のみに修正
            ->when($requestLowSalary, function ($query, $requestLowSalary) {
                return $query->where('jobs.low_salary', '>=', $requestLowSalary)
                    ->orWhere('jobs.high_salary', '>=', $requestLowSalary);
            })
            // ->when($requestHighSalary, function ($query, $requestHighSalary) {
            //     return $query->where('jobs.high_salary', '<=', $requestHighSalary);
            // })
            ->when($requestTags, function ($query, $requestTags) {
                return $query->leftJoin('tag_to_jobs', 'jobs.id', '=', 'tag_to_jobs.jobs_id')
                    ->whereIn('tag_to_jobs.tags_id', $requestTags);
            })
            ->when($requestSearch, function ($query, $requestSearch) {
                $spaceConversion = mb_convert_kana($requestSearch, 's');
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($wordArraySearched as $word) {
                    return $query->where(function ($query) use ($word) {
                        $query->where('job_name', 'like', '%' . $word . '%')
                            ->orWhere('detail', 'like', '%' . $word . '%')
                            ->orWhere('catch', 'like', '%' . $word . '%');
                    });
                }
            })
            ->paginate(50, ['jobs.*']);

        $prefectures = Prefecture::all();
        $occupations = Occupation::all();
        $tags = Tag::where('subject', 1)->get();
        return view('admin.job.search', compact(['jobs', 'prefectures', 'occupations', 'tags', 'requestPrefs', 'requestOccupations', 'requestLowSalary', 'requestTags', 'requestSearch']));
    }
}

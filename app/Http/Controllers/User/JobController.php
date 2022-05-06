<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jobs;
use App\Models\AppStatus;
use App\Models\Prefecture;
use App\Models\Occupation;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class JobController extends Controller
{
    public function index()
    {
        $jobs = DB::table('jobs')->where('rec_status', null)->paginate(12);
        $prefectures = Prefecture::all();
        $occupations = Occupation::all();
        $tags = Tag::where('subject', 1)->get();
        return view('user.job.index', compact(['jobs', 'prefectures', 'occupations', 'tags']));
    }

    public function show($id)
    {
        $job = Jobs::findOrFail($id);
        return view('user.job.show', compact('job'));
    }

    public function application($id)
    {
        $job = Jobs::findOrFail($id);

        // まだAppStatusesテーブルにデータなければ
        $app = AppStatus::where('jobs_id', $id)->where('users_id', Auth::id())->first();
        if (!$app) {
            $app = new AppStatus();
            $app->users_id = Auth::id();
            $app->jobs_id = $id;
            $app->app_flag = true;
            $app->save();
        } else {
            // 既に応募済み
            if ($app->app_flag = true) {
                return back()->with(['message' => '既に応募済みです', 'status' => 'info']);
            } else {
                $app->app_flag = true;
                $app->save();
            }
        }
        // return view('user.job.show', compact('job'))->with(['message' => '応募しました', 'status' => 'info']);
        return redirect()->route('user.jobs.show', ['job' => $id])->with(['message' => '応募しました', 'status' => 'info']);
    }


    public function favorite(Request $request)
    {
        $user_id = Auth::user()->id;
        $job_id = $request->job_id;
        $exist = AppStatus::where('users_id', $user_id)->where('jobs_id', $job_id)->first();
        $already_favorite = AppStatus::where('users_id', $user_id)->where('jobs_id', $job_id)->where('favorite', true)->first();

        // 既にappStatusesテーブルにデータあれば
        if ($exist) {
            // まだお気に入りしてなければ
            if (!$already_favorite) {
                $exist->favorite = true;
                $exist->save();
                // 既にお気に入りしてれば
            } else {
                $already_favorite->favorite = false;
                $already_favorite->save();
            }
            // まだappStatusesテーブルにデータなければ
        } else {
            $favorite = new AppStatus;
            $favorite->jobs_id = $job_id;
            $favorite->users_id = $user_id;
            $favorite->favorite = true;
            $favorite->save();
        }
        return;
    }

    public function search(Request $request)
    {
        $requestPrefs = $request->prefectures;
        $requestOccupations = $request->occupations;
        $requestLowSalary = $request->low_salary;
        $requestHighSalary = $request->high_salary;
        $requestTags = $request->tags;

        $jobs = DB::table('jobs')
            ->when($requestPrefs, function ($query, $requestPrefs) {
                return $query->leftJoin('job_locations', 'jobs.id', '=', 'job_locations.jobs_id')
                    ->whereIn('job_locations.prefectures_id', $requestPrefs);
            })
            ->when($requestOccupations, function ($query, $requestOccupations) {
                return $query->leftJoin('job_occupations', 'jobs.id', '=', 'job_occupations.jobs_id')
                    ->whereIn('job_occupations.occupations_id', $requestOccupations);
            })
            ->when($requestLowSalary, function ($query, $requestLowSalary) {
                return $query->where('jobs.low_salary', '>=', $requestLowSalary);
            })
            ->when($requestHighSalary, function ($query, $requestHighSalary) {
                return $query->where('jobs.high_salary', '<=', $requestHighSalary);
            })
            ->when($requestTags, function ($query, $requestTags) {
                return $query->leftJoin('tag_to_jobs', 'jobs.id', '=', 'tag_to_jobs.jobs_id')
                    ->whereIn('tag_to_jobs.tags_id', $requestTags);
            })
            ->paginate(12, ['jobs.*']);

        $prefectures = Prefecture::all();
        $occupations = Occupation::all();
        $tags = Tag::where('subject', 1)->get();
        return view('user.job.searchIndex', compact(['jobs', 'prefectures', 'occupations', 'tags', 'requestPrefs', 'requestOccupations', 'requestLowSalary', 'requestHighSalary', 'requestTags']));
    }

    public function favoriteIndex()
    {
        $user_id = Auth::id();
        $jobs = AppStatus::where('users_id', $user_id)->where('favorite', 1)->paginate(12);
        // dd($jobs);
        return view('user.job.favoriteIndex', compact('jobs'));
    }

    public function appliedIndex()
    {
        $user_id = Auth::id();
        $jobs = AppStatus::where('users_id', $user_id)->where('app_flag', 1)->paginate(12);
        // dd($jobs);
        return view('user.job.appliedIndex', compact('jobs'));
    }
}

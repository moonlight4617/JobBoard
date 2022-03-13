<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jobs;
use App\Models\AppStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class JobController extends Controller
{
    public function index()
    {
        $jobs = DB::table('jobs')->where('rec_status', null)->paginate(12);
        return view('user.job.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Jobs::findOrFail($id);

        $favorite = AppStatus::where('jobs_id', $id)->where('users_id', Auth::id());

        return view('user.job.show', compact('job', 'favorite'));
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
}

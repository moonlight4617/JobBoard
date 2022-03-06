<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jobs;

class JobController extends Controller
{
    public function index()
    {
        $jobs = DB::table('jobs')->where('rec_status', null)->get();
        // dd($jobs);
        return view('user.job.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = Jobs::findOrFail($id);
        return view('user.job.show', compact('job'));
    }
}

<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class JobSeeker extends Controller
{
    public function index()
    {
        $users = DB::table('users')->where('deleted_at', null)->paginate(12);
        return view('company.user.index', compact('users'));
    }
}

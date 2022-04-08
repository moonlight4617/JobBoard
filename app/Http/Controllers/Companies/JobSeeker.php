<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserPictures;
use App\Models\User;


class JobSeeker extends Controller
{
    public function index()
    {
        // $users = DB::table('users')->where('deleted_at', null)->paginate(12);
        // $pictures = UserPictures::where('users_id', '=', $id)->get();
        $users = User::where('deleted_at', null)->with('userPictures')->paginate(3);
        // dd($users);
        return view('company.user.index', compact('users'));
    }
}

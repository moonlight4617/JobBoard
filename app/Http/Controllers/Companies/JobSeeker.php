<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserPictures;
use App\Models\User;
use App\Models\Companies;
use App\Models\ContactUsers;
use Illuminate\Support\Facades\Auth;



class JobSeeker extends Controller
{
    public function index()
    {
        // $users = DB::table('users')->where('deleted_at', null)->paginate(12);
        // $pictures = UserPictures::where('users_id', '=', $id)->get();
        $users = User::where('deleted_at', null)->with('userPictures')->paginate(12);
        // dd($users);
        return view('company.user.index', compact('users'));
    }

    public function follow(Request $request)
    {
        $company_id = Auth::user()->id;
        $user_id = $request->user_id;
        $exist = ContactUsers::where('companies_id', $company_id)->where('users_id', $user_id)->first();
        $already_followed = ContactUsers::where('companies_id', $company_id)->where('users_id', $user_id)->where('follow', true)->first();

        // 既にcontactUsersテーブルにデータあれば
        if ($exist) {
            // まだフォローしてなければ
            if (!$already_followed) {
                $exist->follow = true;
                $exist->save();
                // 既にフォローしてれば
            } else {
                $already_followed->follow = false;
                $already_followed->save();
            }
            // まだcontactUsersテーブルにデータなければ
        } else {
            $contactUsers = new ContactUsers;
            $contactUsers->users_id = $user_id;
            $contactUsers->companies_id = $company_id;
            $contactUsers->follow = true;
            $contactUsers->save();
        }
        return;
    }

    public function followIndex()
    {
        $company_id = Auth::id();
        // $users = ContactUsers::where('companies_id', $company_id)->where('follow', 1)->paginate(12);
        $users = Companies::findOrFail($company_id)->ContactUsers->where('follow', 1);
        // dd($users);
        return view('company.user.followIndex', compact('users'));
    }
}

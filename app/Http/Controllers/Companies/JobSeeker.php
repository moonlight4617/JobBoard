<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserPictures;
use App\Models\User;
use App\Models\Companies;
use App\Models\ContactUsers;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;



class JobSeeker extends Controller
{
    public function index()
    {
        // $users = DB::table('users')->where('deleted_at', null)->paginate(12);
        // $pictures = UserPictures::where('users_id', '=', $id)->get();
        $users = User::where('deleted_at', null)->with('userPictures')->paginate(12);
        $tags = Tag::where('subject', 0)->get();
        return view('company.user.index', compact(['users', 'tags']));
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

    public function search(Request $request)
    {
        $requestTags = $request->tags;
        if ($requestTags) {
            $usersId = DB::table('tag_to_users')->whereIn('tags_id', $requestTags)->select('users_id');
            $users = User::where('deleted_at', null)->whereIn('id', $usersId)->with('userPictures')->paginate(12);
        } else {
            $users = User::where('deleted_at', null)->with('userPictures')->paginate(12);
        }

        $tags = Tag::where('subject', 0)->get();
        return view('company.user.index', compact(['users', 'tags', 'requestTags']));
    }
}

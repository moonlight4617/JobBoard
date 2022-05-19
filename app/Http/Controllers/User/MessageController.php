<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\ContactUsers;

class MessageController extends Controller
{
    public function index()
    {
        // dd('テスト');
        $companies = ContactUsers::where('users_id', Auth::id())->with('companies')->get();
        return view('user.message.index', compact(['companies']));
    }

    public function show($id)
    {
        // dd($id);
        $ContactUsersId = ContactUsers::where('users_id', Auth::id())->where('companies_id', $id)->select('id')->get();
        $messages = Message::whereIn('contact_users_id', $ContactUsersId)->get();
        return view('user.message.show', compact(['messages']));
    }
}

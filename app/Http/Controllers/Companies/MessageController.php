<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUsers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class MessageController extends Controller
{
    public function index()
    {
        $users = ContactUsers::where('companies_id', Auth::id())->with('users')->get();
        return view('company.message.index', compact(['users']));
    }

    public function show($id)
    {
        $contactUsersId = ContactUsers::where('companies_id', Auth::id())->where('users_id', $id)->select('id')->get();
        $messages = Message::whereIn('contact_users_id', $contactUsersId)->get();
        $user = User::findOrFail($id);
        return view('company.message.show', compact(['contactUsersId', 'messages', 'user']));
    }

    public function post(Request $request)
    {
        $contact_users_id = $request->contact_users_id;
        $contents = $request->contents;
        Message::create(['contact_users_id' => $contact_users_id, 'sent_time' => Carbon::now(), 'sent_from' => 0, 'body' => $contents]);
        return;
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\ContactUsers;
use App\Models\Companies;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index()
    {
        $companies = ContactUsers::where('users_id', Auth::id())->with('companies')->get();
        return view('user.message.index', compact(['companies']));
    }

    public function show($id)
    {
        // $carbon = new Carbon('now');
        // dd(Carbon::now());
        $contactUsersId = ContactUsers::where('users_id', Auth::id())->where('companies_id', $id)->select('id')->get();
        $messages = Message::whereIn('contact_users_id', $contactUsersId)->orderBy('sent_time', 'asc')->get();
        $company = Companies::findOrFail($id);
        return view('user.message.show', compact(['contactUsersId', 'messages', 'company']));
    }

    public function post(Request $request)
    {
        $contact_users_id = $request->contact_users_id;
        $contents = $request->contents;
        Message::create(['contact_users_id' => $contact_users_id, 'sent_time' => Carbon::now(), 'sent_from' => 1, 'body' => $contents]);
        return;
    }
}

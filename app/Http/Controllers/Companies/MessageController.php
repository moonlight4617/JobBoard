<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUsers;
use App\Models\Message;
use App\Models\User;
use App\Models\AppStatus;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
// use App\Mail\SendMassegeMail;
use App\Jobs\SendMessageMail;


class MessageController extends Controller
{
    public function index()
    {
        $users = ContactUsers::where('companies_id', Auth::id())->with('users')->with('messages')->get();
        $jobs = Companies::findOrFail(Auth::id())->jobs()->where('rec_status', '<>', '2')->get();
        return view('company.message.index', compact(['users', 'jobs']));
    }

    public function show($id)
    {
        $contactUsersId = ContactUsers::where('companies_id', Auth::id())->where('users_id', $id)->select('id')->first();
        if ($contactUsersId) {
            $messages = Message::where('contact_users_id', $contactUsersId->id)->orderBy('sent_time', 'asc')->get();
        } else {
            $contactUsers = ContactUsers::create([
                'companies_id' => Auth::id(),
                'users_id' => $id
            ]);
            $contactUsersId = $contactUsers;
            $messages = null;
        }
        $user = User::findOrFail($id);
        return view('company.message.show', compact(['contactUsersId', 'messages', 'user']));
    }

    public function post(Request $request)
    {
        $contact_users_id = $request->contact_users_id;
        $contents = $request->contents;
        $userId = $request->userId;
        $user = User::findOrFail($userId);
        $company = Companies::findOrFail(Auth::id());
        Message::create(['contact_users_id' => $contact_users_id, 'sent_time' => Carbon::now(), 'sent_from' => 0, 'body' => $contents]);

        // 非同期でメール送信
        SendMessageMail::dispatch($company, $user);

        // 同期的にメール送信。使う場合は上部のuseコメントアウト外す。
        // Mail::to($user->email)->send(new SendMassegeMail($company, route('user.message.show', ['company' => $company->id])));

        return;
    }
}

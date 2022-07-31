<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\ContactUsers;
use App\Models\Companies;
use App\Models\User;
use App\Models\Jobs;
use App\Models\AppStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
//use App\Mail\SendMassegeMail;
use App\Jobs\SendMessageMail;


class MessageController extends Controller
{
    public function index()
    {
        $companies = ContactUsers::where('users_id', Auth::id())->with('companies')->with('messages')->paginate(50);

        // $users = ContactUsers::where('companies_id', Auth::id())->with('users')->with('messages')->get();
        // $jobs = User::findOrFail(Auth::id())->appStatus()->where('app_flag', 1)->jobs()->get();
        $jobsId = AppStatus::where('users_id', Auth::id())->where('app_flag', 1)->pluck('jobs_id');
        $jobs = Jobs::whereIn('id', $jobsId)->get();

        return view('user.message.index', compact(['companies', 'jobs']));
    }

    public function show($id)
    {
        // $carbon = new Carbon('now');
        // dd(Carbon::now());
        $contactUsersId = ContactUsers::where('users_id', Auth::id())->where('companies_id', $id)->select('id')->get();
        if ($contactUsersId->first() == null) {
            // ContactUsers作成
            $contactUsersId = ContactUsers::create([
                'users_id' => Auth::id(),
                'companies_id' => $id,
                'follow' => 0
            ]);
        }
        $messages = Message::whereIn('contact_users_id', $contactUsersId)->orderBy('sent_time', 'asc')->get();
        $company = Companies::findOrFail($id);
        return view('user.message.show', compact(['contactUsersId', 'messages', 'company']));
    }

    public function post(Request $request)
    {
        $contact_users_id = $request->contact_users_id;
        $contents = $request->contents;
        $companyId = $request->companyId;
        $company = Companies::findOrFail($companyId);
        $user = User::findOrFail(Auth::id());
        Message::create(['contact_users_id' => $contact_users_id, 'sent_time' => Carbon::now(), 'sent_from' => 1, 'body' => $contents]);

        // 非同期でメール送信
        // SendMessageMail::dispatch($user, $company);

        // 同期的にメール送信。使う場合は上部のuseコメントアウト外す。
        // Mail::to($company->email)->send(new SendMassegeMail($user, route('company.message.show', ['user' => $user->id])));

        return;
    }
}

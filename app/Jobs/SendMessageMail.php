<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMassegeMail;


class SendMessageMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $user;
    public $company;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $company)
    {
        $this->user = $user;
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (get_class($this->user) === 'App\Models\User') {
            Mail::to($this->company->email)->send(new SendMassegeMail($this->user, route('company.message.show', ['user' => $this->user->id])));
        } elseif (get_class($this->user) === 'App\Models\Companies') {
            Mail::to($this->company->email)->send(new SendMassegeMail($this->user, route('user.message.show', ['company' => $this->user->id])));
        }
    }
}

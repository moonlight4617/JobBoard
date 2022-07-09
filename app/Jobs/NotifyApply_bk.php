<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppliedMail;
use App\Mail\ApplyMail;

class NotifyApply implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $job;
    public $pages;
    public $user;
    public $company;
    public $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $company, $job, $id)
    {
        $this->user = $user;
        $this->company = $company;
        $this->job = $job;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($user, $company, $job, $id)
    {
        // Mail::to($user->email)->send(new ApplyMail($job, route('user.jobs.show', ['job' => $id])));
        // Mail::to($company->email)->send(new AppliedMail($job, route('company.jobs.show', ['job' => $id])));
        return;
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMassegeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $pages)
    {
        $this->user = $user;
        $this->pages = $pages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('jobpairに新しいメッセージが届きました')->view('emails.sendMessage')->with([
            'user' => $this->user->name,
            'page' => $this->pages
        ]);
    }
}

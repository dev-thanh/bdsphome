<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ForgotPassword implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        $content_email = $event->content_mail;

        $email = $event->request;

        Mail::send('frontend.mail.mail-resetpassword', $content_email, function ($msg) use($email) {
            $msg->from(config('mail.mail_from'), 'Behe Shop');
            $msg->to($email, 'Behe Shop')->subject('Reset Password');
        });
    }
}

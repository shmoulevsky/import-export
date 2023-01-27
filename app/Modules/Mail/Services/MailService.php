<?php

namespace App\Modules\Mail\Services;

use App\Modules\Mail\Emails\CommonEmail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function send($to, $subject, $message)
    {
        Mail::to($to)->send(new CommonEmail( $subject,$message));
    }
}

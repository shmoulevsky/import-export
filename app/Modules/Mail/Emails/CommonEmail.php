<?php

namespace App\Modules\Mail\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($subject, $text)
    {
        $this->text = $text;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->from('info@import-export.app')
            ->subject($this->subject)
            ->view('mails.common')
            ->with(['text' => $this->text]);
    }
}

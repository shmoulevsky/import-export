<?php

namespace App\Modules\Result\Services;

use App\Modules\Mail\Services\MailService;
use App\Modules\Result\Models\Result;

class ResultNotifyService
{
    public function handle(Result $result)
    {
        $mailService = new MailService();
        $subject = "Operation #{$result->id} has been finished";
        $message = "Operation #{$result->id} (type:{$result->type} / route:{$result->route}) has been finished";

        if($result->route === 'api/export'){
            $path = url('/').'/storage/export-'.$result->type.".csv";
            $message .= "<br/>Download: <a href='{$path}'>export result</a>";
        }

        $mailService->send("admin@import-export.app", $subject, $message);
    }
}

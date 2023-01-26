<?php

namespace App\Modules\Result\Jobs;

use App\Modules\Result\Services\ResultService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResultFinishJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $resultId;

    public function __construct($resultId)
    {
        $this->resultId = $resultId;
    }


    public function handle()
    {
        $resultService = new ResultService();
        $resultService->finish($this->resultId);

    }


}

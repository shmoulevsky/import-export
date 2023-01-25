<?php

namespace App\Modules\User\Services\Export\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;
    private $type;
    private $path;
    private $modelName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($service, $path, $modelName)
    {
        $this->service = $service;
        $this->path = $path;
        $this->modelName = $modelName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model = app()->make($this->modelName);
        $this->service->import($this->path, $model);
    }
}

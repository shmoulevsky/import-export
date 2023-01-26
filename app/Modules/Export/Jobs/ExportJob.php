<?php

namespace App\Modules\Export\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;
    private $type;
    private $path;
    private $fields;
    private $modelName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($service, $path, $fields, $modelName)
    {

        $this->service = $service;
        $this->path = $path;
        $this->fields = $fields;
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
        $result = $this->service->export($this->path, $this->fields, $model);
    }
}

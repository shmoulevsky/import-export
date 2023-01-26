<?php

namespace App\Modules\Import\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;
    private $type;
    private $path;
    private $modelName;
    private $fields;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($service, $path, $fields, $modelName)
    {
        $this->service = $service;
        $this->path = $path;
        $this->modelName = $modelName;
        $this->fields = $fields;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model = app()->make($this->modelName);
        $this->service->import($this->path, $this->fields, $model);
    }
}

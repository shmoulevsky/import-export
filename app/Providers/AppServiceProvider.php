<?php

namespace App\Providers;

use App\Modules\Result\Services\ResultService;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('cyrillic', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/[А-Яа-яЁё]/u', $value);
        });

        Queue::after(function (JobProcessed $event) {

            $data = unserialize($event->job->payload()['data']['command']);
            $resultService = new ResultService();

            if($data?->resultId){
                $resultService->finish($data->resultId);
            }
        });

    }
}

<?php

namespace App\Modules\User\Services\Import\Factory;


use App\Modules\User\Services\Import\Intrefaces\ImportInterface;
use App\Modules\User\Services\Import\Handlers\ImportLaravelExcelService;
use App\Modules\User\Services\Import\Handlers\ImportPhpService;
use App\Modules\User\Services\Import\Handlers\ImportSpatieExcelService;

class ImportServiceFactory
{
    public function make(string $type) : ImportInterface
    {
        switch ($type){
            case 'php' : return app()->make(ImportPhpService::class);
            case 'laravel-excel' : return app()->make(ImportLaravelExcelService::class);
            case 'spatie-excel' : return app()->make(ImportSpatieExcelService::class);
        }
    }
}

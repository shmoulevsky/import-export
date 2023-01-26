<?php

namespace App\Modules\Import\Factory;


use App\Modules\Import\Handlers\ImportLaravelExcelService;
use App\Modules\Import\Handlers\ImportPhpService;
use App\Modules\Import\Handlers\ImportSpatieExcelService;
use App\Modules\Import\Interfaces\ImportInterface;

class ImportServiceFactory
{
    public function make(string $type) : ?ImportInterface
    {
        switch ($type){
            case 'php' : return app()->make(ImportPhpService::class);
            case 'laravel-excel' : return app()->make(ImportLaravelExcelService::class);
            case 'spatie-excel' : return app()->make(ImportSpatieExcelService::class);
        }

        return null;
    }
}

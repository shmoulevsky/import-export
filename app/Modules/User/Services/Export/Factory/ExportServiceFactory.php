<?php

namespace App\Modules\User\Services\Export\Factory;

use App\Modules\User\Services\Export\Handlers\ImportLaravelExcelService;
use App\Modules\User\Services\Export\Handlers\ImportPhpService;
use App\Modules\User\Services\Export\Handlers\ImportSpatieExcelService;
use App\Modules\User\Services\Export\Interfaces\ExportInterface;

class ExportServiceFactory
{
    public function make(string $type) : ExportInterface
    {
        switch ($type){
            case 'php' : return app()->make(ImportPhpService::class);
            case 'laravel-excel' : return app()->make(ImportLaravelExcelService::class);
            case 'spatie-excel' : return app()->make(ImportSpatieExcelService::class);
        }
    }
}

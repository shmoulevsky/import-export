<?php

namespace App\Modules\Export\Factory;

use App\Modules\Export\Handlers\ExportLaravelExcelService;
use App\Modules\Export\Handlers\ExportPhpService;
use App\Modules\Export\Handlers\ExportSpatieExcelService;
use App\Modules\Export\Interfaces\ExportInterface;

class ExportServiceFactory
{
    public function make(string $type) : ExportInterface
    {
        switch ($type){
            case 'php' : return app()->make(ExportPhpService::class);
            case 'laravel-excel' : return app()->make(ExportLaravelExcelService::class);
            case 'spatie-excel' : return app()->make(ExportSpatieExcelService::class);
        }
    }
}

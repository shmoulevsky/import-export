<?php

namespace App\Modules\User\Services\Export\Factory;

use App\Modules\User\Services\Export\Handlers\ExportLaravelExcelService;
use App\Modules\User\Services\Export\Handlers\ExportPhpService;
use App\Modules\User\Services\Export\Handlers\ExportSpatieExcelService;
use App\Modules\User\Services\Export\Interfaces\ExportInterface;

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

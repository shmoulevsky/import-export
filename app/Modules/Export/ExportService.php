<?php

namespace App\Modules\Export;

use App\Modules\Export\Entities\ExportType;
use App\Modules\Export\Factory\ExportServiceFactory;
use App\Modules\Export\Jobs\ExportJob;

class ExportService
{
    private ExportServiceFactory $factory;

    public function __construct(ExportServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(string $type,string $filename, array $fields, $model, $resultId)
    {
        $service = $this->factory->make($type);

        if($type === ExportType::LARAVEL_EXCEL){
            $service->export($filename, $fields, $model, $resultId);
            return 1;
        }

        dispatch(new ExportJob($service, $filename, $fields, $model, $resultId));
        return 1;
    }
}

<?php

namespace App\Modules\User\Services\Export;

use App\Modules\User\Services\Export\Entities\ExportType;
use App\Modules\User\Services\Export\Factory\ExportServiceFactory;
use App\Modules\User\Services\Export\Jobs\ExportJob;

class ExportService
{
    private ExportServiceFactory $factory;

    public function __construct(ExportServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(string $type,string $filename, array $fields, $model)
    {
        $service = $this->factory->make($type);

        if($type === ExportType::LARAVEL_EXCEL){
            $service->export($filename, $fields, $model);
            return 1;
        }

        dispatch(new ExportJob($service, $filename, $fields, $model));
        return 1;
    }
}

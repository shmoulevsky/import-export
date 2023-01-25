<?php

namespace App\Modules\User\Services\Import;

use App\Modules\User\Services\Export\Entities\ImportType;
use App\Modules\User\Services\Export\Jobs\ImportJob;
use App\Modules\User\Services\Import\Factory\ImportServiceFactory;

class ImportService
{
    private ImportServiceFactory $factory;

    public function __construct(ImportServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(string $type,string $filename, $modelName)
    {
        $service = $this->factory->make($type);

        if($type === ImportType::LARAVEL_EXCEL){
            $service->import($filename, $modelName);
            return 1;
        }

        dispatch(new ImportJob($service, $filename, $modelName));
        return 1;

    }
}

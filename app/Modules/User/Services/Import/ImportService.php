<?php

namespace App\Modules\User\Services\Import;

use App\Modules\User\Services\Import\Entities\ImportType;
use App\Modules\User\Services\Import\Jobs\ImportJob;
use App\Modules\User\Services\Import\Factory\ImportServiceFactory;

class ImportService
{
    private ImportServiceFactory $factory;

    public function __construct(ImportServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(string $type,string $filename, array $fields, $modelName)
    {
        $service = $this->factory->make($type);

        if($type === ImportType::LARAVEL_EXCEL){
            $service->import($filename, $fields, $modelName);
            return 1;
        }

        dispatch(new ImportJob($service, $filename, $fields, $modelName));
        return 1;

    }
}

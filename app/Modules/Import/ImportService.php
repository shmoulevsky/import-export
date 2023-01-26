<?php

namespace App\Modules\Import;

use App\Modules\Import\Entities\ImportType;
use App\Modules\Import\Factory\ImportServiceFactory;
use App\Modules\Import\Jobs\ImportJob;

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

<?php

namespace App\Modules\User\Services\Import;

use App\Modules\User\Services\Import\Factory\ImportServiceFactory;

class ImportUserService
{
    private ImportServiceFactory $factory;

    public function __construct(ImportServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(string $type,string $filename, $model)
    {
        $service = $this->factory->make($type);
        $result = $service->import($filename, $model);
        return $result;
    }
}

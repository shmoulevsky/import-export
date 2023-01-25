<?php

namespace App\Modules\User\Services\Export;

use App\Modules\User\Services\Export\Factory\ExportServiceFactory;

class ExportUserService
{
    private ExportServiceFactory $factory;

    public function __construct(ExportServiceFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(string $type,string $filename, array $fields, $model)
    {
        $service = $this->factory->make($type);
        $result = $service->export($filename, $fields, $model);
        return $result;
    }
}

<?php

namespace App\Modules\User\Services\Export\Handlers;

use App\Modules\User\Services\Export\Handlers\LaravelExcel\UserExport;
use App\Modules\User\Services\Export\Interfaces\ExportInterface;

class ImportLaravelExcelService implements ExportInterface
{
    public function export($filename, array $fields, $model)
    {
        fopen($filename, 'w');
        (new UserExport($fields))->queue($filename);
    }
}

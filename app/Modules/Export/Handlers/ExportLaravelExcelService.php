<?php

namespace App\Modules\Export\Handlers;

use App\Modules\Export\Handlers\LaravelExcel\UserExport;
use App\Modules\Export\Interfaces\ExportInterface;
use App\Modules\Result\Jobs\ResultFinishJob;

class ExportLaravelExcelService implements ExportInterface
{
    public function export($filename, array $fields, $model, $resultId)
    {
        fopen($filename, 'w');
        (new UserExport($fields, $resultId))->queue($filename)->chain([
            new ResultFinishJob($resultId)
        ]);
    }
}

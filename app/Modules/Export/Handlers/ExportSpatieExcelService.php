<?php

namespace App\Modules\Export\Handlers;

use App\Modules\Export\Interfaces\ExportInterface;
use App\Modules\Result\Services\ResultService;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportSpatieExcelService implements ExportInterface
{
    const SIZE = 200;

    public function export(string $filename, array $fields, $model, $resultId)
    {

        $file = SimpleExcelWriter::create($filename);

        $model::select($fields)->chunk(self::SIZE, function($items) use ($file){

            $rows = [];

            foreach ($items as $item) {
                $rows[] = $item->toArray();
            }

            $file->addRows($rows);

        });

    }
}

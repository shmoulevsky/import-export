<?php

namespace App\Modules\Export\Handlers;

use App\Modules\Export\Interfaces\ExportInterface;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportSpatieExcelService implements ExportInterface
{
    const SIZE = 200;

    public function export(string $filename, array $fields, $model, $resultId)
    {

        $model::select($fields)->chunk(self::SIZE, function($items) use ($filename){

            $rows = [];

            foreach ($items as $item) {
                $rows[] = $item->toArray();
            }

            SimpleExcelWriter::create($filename)->addRows($rows);

        });

    }
}

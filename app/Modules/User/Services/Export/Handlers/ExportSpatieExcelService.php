<?php

namespace App\Modules\User\Services\Export\Handlers;

use App\Modules\User\Services\Export\Interfaces\ExportInterface;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ExportSpatieExcelService implements ExportInterface
{
    const SIZE = 200;

    public function export(string $filename, array $fields, $model)
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

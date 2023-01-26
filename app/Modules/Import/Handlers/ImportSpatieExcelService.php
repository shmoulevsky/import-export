<?php

namespace App\Modules\Import\Handlers;


use App\Modules\Import\Interfaces\ImportInterface;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportSpatieExcelService implements ImportInterface
{

    public function import(string $filename, $fields, $model)
    {
        SimpleExcelReader::create($filename)->getRows()
            ->each(function(array $row) {

            });
    }
}

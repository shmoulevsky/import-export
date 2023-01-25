<?php

namespace App\Modules\User\Services\Import\Handlers;


use App\Modules\User\Services\Import\Interfaces\ImportInterface;
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

<?php

namespace App\Modules\User\Services\Import\Handlers;


use App\Modules\User\Services\Import\Handlers\LaravelExcel\UserImport;
use App\Modules\User\Services\Import\Interfaces\ImportInterface;
use Maatwebsite\Excel\Facades\Excel;

class ImportLaravelExcelService implements ImportInterface
{
    public function import($filename, $fields, $model)
    {
        try {
            Excel::queueImport(new UserImport(), $filename, 'public', \Maatwebsite\Excel\Excel::CSV);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            $failures = $e->failures();

            foreach ($failures as $failure) {
                echo $failure->row();
                echo $failure->attribute();
                echo $failure->errors();
                echo $failure->values();
            }
        }

    }
}

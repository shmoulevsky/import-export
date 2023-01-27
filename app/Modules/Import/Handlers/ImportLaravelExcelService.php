<?php

namespace App\Modules\Import\Handlers;


use App\Modules\Import\Handlers\LaravelExcel\UserImport;
use App\Modules\Import\Interfaces\ImportInterface;
use App\Modules\Result\Jobs\ResultFinishJob;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportLaravelExcelService implements ImportInterface
{
    public function import($filename, $fields, $model, $resultId)
    {
        try {
            Excel::queueImport(new UserImport($resultId), $filename, null, \Maatwebsite\Excel\Excel::CSV)->chain([
                new ResultFinishJob($resultId)
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            $failures = $e->failures();

            foreach ($failures as $failure) {
                echo $failure->row();
                echo $failure->attribute();
                echo $failure->errors();
                echo $failure->values();
            }
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }

    }
}

<?php

namespace App\Modules\Import\Handlers;


use App\Modules\Import\Interfaces\ImportInterface;
use App\Modules\Result\Services\ResultService;
use App\Modules\Validation\Services\ValidationRowService;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportSpatieExcelService implements ImportInterface
{

    public function import(string $filename, $fields, $model, $resultId)
    {
        $line = 1;
        $output = [];
        $errors = [];
        $validationService = new ValidationRowService();

        SimpleExcelReader::create($filename)->getRows()
            ->each(function(array $row) use($fields, &$line, $validationService, &$output, &$errors) {

                $row = array_values($row);
                $validationService->handle($row, $fields, $line);

                if ($validationService->fails()){
                    $errors[] = $validationService->getErrors();
                }else{
                    $output[] = $validationService->validated();
                }

                $line++;

            });

        Log::error(print_r($errors, true));

        if(count($output) > 0){
            $model::insert($output);
        }
    }
}

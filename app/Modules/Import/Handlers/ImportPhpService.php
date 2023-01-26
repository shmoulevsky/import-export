<?php

namespace App\Modules\Import\Handlers;

use App\Modules\Import\Interfaces\ImportInterface;
use App\Modules\Result\Services\ResultService;
use App\Modules\Validation\Services\ValidationRowService;
use Illuminate\Support\Facades\Log;

class ImportPhpService implements ImportInterface
{
    public function import(string $filename, array $fields,  $model, $resultId)
    {

        $file = fopen($filename, "r");
        $line = 1;
        $output = [];
        $errors = [];
        $validationService = new ValidationRowService();

        while (($data = fgets($file)) !== false) {

            $row = str_getcsv($data,',');
            $validationService->handle($row, $fields, $line);

            if ($validationService->fails()){
                $errors[] = $validationService->getErrors();
                $line++;
                continue;
            }

            $output[] = $validationService->validated();
            $line++;

        }

        if(count($output) > 0){
            $model::insert($output);
        }

        fclose($file);
    }
}

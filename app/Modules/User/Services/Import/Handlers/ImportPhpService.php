<?php

namespace App\Modules\User\Services\Import\Handlers;

use App\Modules\User\Services\Import\Interfaces\ImportInterface;
use App\Modules\User\Services\Validation\Services\ValidationRowService;
use Illuminate\Support\Facades\Log;

class ImportPhpService implements ImportInterface
{
    public function import(string $filename, array $fields,  $model)
    {

        $file = fopen($filename, "r");
        $line = 1;
        $output = [];
        $validationService = new ValidationRowService();

        while (($data = fgets($file)) !== false) {

            $row = str_getcsv($data,',');
            $validationService->handle($row, $fields, $line);

            if ($validationService->fails()){
                Log::info(print_r($validationService->getErrors(), true));
                $line++;
                continue;
            }

            $output[] = $validationService->validated();
            $line++;

        }

        Log::info($output);

        fclose($file);
    }
}

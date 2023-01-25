<?php

namespace App\Modules\User\Services\Import\Handlers;

use App\Modules\User\Services\Import\Interfaces\ImportInterface;

class ImportPhpService implements ImportInterface
{
    public function import(string $filename,  $model)
    {

        $file = fopen($filename, "r");
        $line = 1;

        while (($data = fgets($file)) !== false) {
            $row = str_getcsv($data);
            $line++;
        }

        fclose($file);
    }
}

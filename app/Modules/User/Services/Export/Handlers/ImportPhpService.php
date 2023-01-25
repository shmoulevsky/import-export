<?php

namespace App\Modules\User\Services\Export\Handlers;

use App\Modules\User\Services\Export\Interfaces\ExportInterface;

class ImportPhpService implements ExportInterface
{
    private const SIZE = 200;
    public function export(string $filename, array $fields, $model)
    {
        $file = fopen($filename, 'w');
        $model::select($fields)->chunk(self::SIZE, function($items) use ($file){
            foreach ($items as $item) {
                fputcsv($file, $item->toArray());
            }
        });
    }
}

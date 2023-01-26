<?php

namespace App\Modules\Export\Handlers;

use App\Modules\Export\Interfaces\ExportInterface;

class ExportPhpService implements ExportInterface
{
    private const SIZE = 200;
    public function export(string $filename, array $fields, $model, $resultId)
    {
        $file = fopen($filename, 'w');
        $model::select($fields)->chunk(self::SIZE, function($items) use ($file){
            foreach ($items as $item) {
                fputcsv($file, $item->toArray());
            }
        });
    }
}

<?php

namespace App\Modules\Export\Interfaces;

interface ExportInterface
{
    public function export(string $filename, array $fields, $model, $resultId);
}

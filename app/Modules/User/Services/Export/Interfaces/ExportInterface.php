<?php

namespace App\Modules\User\Services\Export\Interfaces;

interface ExportInterface
{
    public function export(string $filename, array $fields, $model);
}

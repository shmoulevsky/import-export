<?php

namespace App\Modules\Import\Interfaces;

interface ImportInterface
{
    public function import(string $filename, array $fields, $model, $resultId);
}

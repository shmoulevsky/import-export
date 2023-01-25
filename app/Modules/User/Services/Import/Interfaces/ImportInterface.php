<?php

namespace App\Modules\User\Services\Import\Interfaces;

interface ImportInterface
{
    public function import(string $filename, $model);
}

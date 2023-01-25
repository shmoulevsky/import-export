<?php

namespace App\Modules\User\Services\Import\Handlers\LaravelExcel;

use App\Modules\User\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UserImport implements FromQuery
{
    use Exportable;

    private array $fields;

    public function __construct(array $fields)
    {
        $this->fields = $fields;
    }

    public function query()
    {
        return User::query()->select($this->fields);
    }
}

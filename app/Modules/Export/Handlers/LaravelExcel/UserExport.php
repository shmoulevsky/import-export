<?php

namespace App\Modules\Export\Handlers\LaravelExcel;

use App\Modules\Result\Services\ResultService;
use App\Modules\User\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UserExport implements FromQuery
{
    use Exportable;

    private array $fields;
    private int $resultId;

    public function __construct(array $fields, int $resultId)
    {
        $this->fields = $fields;
        $this->resultId = $resultId;
    }

    public function query()
    {
        return User::query()->select($this->fields);
    }
}

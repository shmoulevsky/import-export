<?php

namespace App\Modules\User\Services\Import\Handlers\LaravelExcel;


use App\Modules\User\Models\User;
use App\Modules\User\Services\Import\Entities\ValidationRules;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\Rules\Password;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class UserImport implements ToModel, WithValidation, SkipsOnFailure, ShouldQueue,  WithChunkReading, WithBatchInserts, WithUpserts
{
    use Importable;

    const COUNT = 100;
    private ImportResultDTO $result;

    public function __construct()
    {
    }

    public function model(array $row)
    {
        return new User([
            'user_name'     => $row[0],
            'first_name'     => $row[1],
            'last_name'     => $row[2],
            'patronymic'    => $row[3],
            'email'    => $row[4],
            'password'    => $row[5],

        ]);
    }

    public function rules(): array
    {
        return [
            '*.0' => ValidationRules::USER_NAME,
            '*.1' => ValidationRules::FIRST_NAME,
            '*.2' => ValidationRules::LAST_NAME,
            '*.3' => ValidationRules::PATRONYMIC,
            '*.4' => ValidationRules::EMAIL,
            '*.5' => ValidationRules::getPassword(),
        ];
    }

    public function onFailure(Failure ...$failures)
    {

    }

    public function chunkSize(): int
    {
        return self::COUNT;
    }

    public function batchSize(): int
    {
        return self::COUNT;
    }

    public function uniqueBy()
    {
        return ['email', 'user_name'];
    }
}


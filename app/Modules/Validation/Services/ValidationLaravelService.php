<?php

namespace App\Modules\Validation\Services;

use App\Modules\Import\Entities\ValidationRules;
use Illuminate\Support\Facades\Validator;

class ValidationLaravelService
{
    public static function handle(array $row, array $fields)
    {
        $info = array_combine(array_map(function($el) use ($fields) {
            return $fields[$el];
        }, array_keys($row)), array_values($row));

        return Validator::make($info, [
            'user_name' => ValidationRules::USER_NAME,
            'first_name' => ValidationRules::FIRST_NAME,
            'last_name' => ValidationRules::LAST_NAME,
            'patronymic' => ValidationRules::PATRONYMIC,
            'email' => ValidationRules::EMAIL,
            'password' => ValidationRules::getPassword(),
        ]);

    }
}

<?php

namespace App\Modules\User\Services\Validation\Rules;

use App\Modules\User\Services\Validation\Rules\Interfaces\RuleInterface;

class PasswordRule implements RuleInterface
{
    public function validate($value, $line, $field) : ?string
    {
        return null;
    }
}

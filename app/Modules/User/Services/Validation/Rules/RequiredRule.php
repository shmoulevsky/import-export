<?php

namespace App\Modules\User\Services\Validation\Rules;

use App\Modules\User\Services\Validation\Rules\Interfaces\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate($value, $line, $field) : ?string
    {
        if(empty($value)) return "The field {$field} is required. Line: {$line}";
        return null;
    }
}

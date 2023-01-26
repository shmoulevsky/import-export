<?php

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Rules\Interfaces\RuleInterface;

class RequiredRule implements RuleInterface
{
    public function validate($value, $line, $field) : ?string
    {
        if(empty($value)) return "The field {$field} is required. Line: {$line}";
        return null;
    }
}

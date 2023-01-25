<?php

namespace App\Modules\User\Services\Validation\Rules;

class RequiredRule
{
    public function validate($value, $line, $field)
    {
        if(empty($value)) return "The field {$field} is required. Line: {$line}";
        return null;
    }
}

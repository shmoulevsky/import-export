<?php

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Rules\Interfaces\RuleInterface;

class EmailRule implements RuleInterface
{
    public function validate($value, $line, $field) : ?string
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return "The field {$field} ({$value}) has not valid e-mail address. Line: {$line}";
        }
        return null;
    }
}

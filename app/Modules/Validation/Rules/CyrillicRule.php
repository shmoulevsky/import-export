<?php

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Rules\Interfaces\RuleInterface;

class CyrillicRule implements RuleInterface
{
    public function validate($value, $line, $field) : ?string
    {
        if(!preg_match('/[А-Яа-яЁё]/u', $value)) return "The field {$field} ({$value}) should be cyrillic. Line: {$line}";
        return null;
    }
}

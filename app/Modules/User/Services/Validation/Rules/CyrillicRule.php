<?php

namespace App\Modules\User\Services\Validation\Rules;

class CyrillicRule
{
    public function validate($value, $line, $field)
    {
        if(!preg_match('/[А-Яа-яЁё]/u', $value)) return "The field {$field} should be cyrillic. Line: {$line}";
        return null;
    }
}

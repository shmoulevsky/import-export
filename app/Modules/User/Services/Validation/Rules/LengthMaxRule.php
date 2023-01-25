<?php

namespace App\Modules\User\Services\Validation\Rules;

class LengthMaxRule
{
    private string $length;

    public function __construct($name)
    {
        $params = explode(':', $name);
        $this->length = $params[1];

    }

    public function validate($value, $line, $field)
    {
        if(strlen($value) > $this->length) return "The field {$field} ({$value}) has value over max {$this->length}. Line: {$line}";
        return null;
    }
}

<?php

namespace App\Modules\User\Services\Validation\Rules;

class LengthMinRule
{
    private string $length;

    public function __construct($name)
    {
        $params = explode(':', $name);
        $this->length = $params[1];

    }

    public function validate($value, $line, $field)
    {
        if(strlen($value) < $this->length) return "The field {$field} ({$value}) has value less then min {$this->length}. Line: {$line}";
        return null;
    }
}

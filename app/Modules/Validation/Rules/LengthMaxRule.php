<?php

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Rules\Interfaces\RuleInterface;

class LengthMaxRule implements RuleInterface
{
    private string $length;

    public function __construct($name)
    {
        $params = explode(':', $name);
        $this->length = $params[1];

    }

    public function validate($value, $line, $field) : ?string
    {
        if(strlen($value) > $this->length) return "The field {$field} ({$value}) has value over max {$this->length}. Line: {$line}";
        return null;
    }
}

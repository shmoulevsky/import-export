<?php

namespace App\Modules\User\Services\Validation\Rules;

class LengthMaxRule
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function validate($value, $line, $field)
    {
        return null;
    }
}

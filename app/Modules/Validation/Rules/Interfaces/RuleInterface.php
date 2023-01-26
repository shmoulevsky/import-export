<?php

namespace App\Modules\Validation\Rules\Interfaces;

interface RuleInterface
{
    public function validate($value, $line, $field) : ?string;
}

<?php

namespace App\Modules\User\Services\Validation\Rules\Interfaces;

interface RuleInterface
{
    public function validate($value, $line, $field) : ?string;
}

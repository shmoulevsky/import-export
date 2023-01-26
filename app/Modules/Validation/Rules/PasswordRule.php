<?php

namespace App\Modules\Validation\Rules;

use App\Modules\Validation\Rules\Interfaces\RuleInterface;

class PasswordRule implements RuleInterface
{
    public function validate($value, $line, $field) : ?string
    {
        $pattern = '/^(?=.*[!@#$%^&*-_])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{8,25}$/';
        $validated = preg_match($pattern, $value);

        if(!$validated) {
            return "The field {$field} ({$value}) has not valid password: it should be more then 8 characters (less then 25), include at least one upper case letter, one number, and one special character";
        }

        return null;
    }
}

<?php

namespace App\Modules\Validation\Factories;

use App\Modules\Validation\Rules\CyrillicRule;
use App\Modules\Validation\Rules\EmailRule;
use App\Modules\Validation\Rules\LengthMaxRule;
use App\Modules\Validation\Rules\LengthMinRule;
use App\Modules\Validation\Rules\PasswordRule;
use App\Modules\Validation\Rules\RequiredRule;
use App\Modules\Validation\Rules\UniqueRule;

class RuleFactory
{
    public static function make(string $type)
    {
        switch ($type){
            case 'required' : return new RequiredRule();
            case str_contains($type, 'unique') : return new UniqueRule($type);
            case 'cyrillic' : return new CyrillicRule();
            case str_contains($type, 'max') : return new LengthMaxRule($type);
            case str_contains($type, 'min') : return new LengthMinRule($type);
            case 'email' : return new EmailRule();
            case 'password' : return new PasswordRule();
        }
    }
}

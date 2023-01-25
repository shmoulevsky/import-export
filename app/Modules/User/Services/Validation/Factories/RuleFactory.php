<?php

namespace App\Modules\User\Services\Validation\Factories;

use App\Modules\User\Services\Validation\Rules\CyrillicRule;
use App\Modules\User\Services\Validation\Rules\EmailRule;
use App\Modules\User\Services\Validation\Rules\LengthMaxRule;
use App\Modules\User\Services\Validation\Rules\LengthMinRule;
use App\Modules\User\Services\Validation\Rules\LengthRule;
use App\Modules\User\Services\Validation\Rules\PasswordRule;
use App\Modules\User\Services\Validation\Rules\RequiredRule;
use App\Modules\User\Services\Validation\Rules\UniqueRule;

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

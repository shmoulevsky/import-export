<?php

namespace App\Modules\User\Services\Import\Entities;

use Illuminate\Validation\Rules\Password;

class ValidationRules
{
    public const USER_NAME = ['required','max:100','unique:users,user_name'];
    public const FIRST_NAME = ['required','cyrillic','max:255'];
    public const LAST_NAME = ['required','cyrillic','max:255'];
    public const PATRONYMIC = ['nullable','cyrillic','max:255'];
    public const EMAIL = ['required','email','max:255'];


    public static function getPassword()
    {
        return ['required','max:255', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()];
    }

}

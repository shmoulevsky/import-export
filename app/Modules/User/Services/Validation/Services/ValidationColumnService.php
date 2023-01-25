<?php

namespace App\Modules\User\Services\Validation\Services;

use App\Modules\User\Services\Validation\DTO\ValidateDTO;
use App\Modules\User\Services\Validation\Factories\RuleFactory;


class ValidationColumnService
{

    public static function handle($field, $value, $line, $rules)
    {
        $errors = [];
        $isValid = true;

        foreach ($rules as $rule){
            $ruleService = RuleFactory::make($rule);
            $result = $ruleService->validate($value, $line, $field);
            if(empty($result)) continue;
            $errors[] = $result;
        }

        if(count($errors) > 0){
            $isValid = false;
        }

        return new ValidateDTO($value, $errors, $line, $field, $isValid);
    }


}

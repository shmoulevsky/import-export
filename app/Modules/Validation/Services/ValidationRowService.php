<?php

namespace App\Modules\Validation\Services;


class ValidationRowService
{

    private array $result;

    public function handle(array $row, array $fields, int $line)
    {
        $this->result = [];
        $count = 0;

        foreach ($fields as $key => $field){
            $this->result[$key] = ValidationColumnService::handle($key, $row[$count], $line, $field);
            $count++;
        }

    }

    public function fails()
    {
        foreach ($this->result as $key => $result){
            if(count($result->errors) > 0){
                return true;
            }
        }

        return false;
    }

    public function getErrors()
    {
        $errors = [];

        foreach ($this->result as $key => $result){
            if(empty($result->errors)) continue;
            $errors[$key] = $result->errors;
        }

        return $errors;
    }

    public function validated()
    {
        $validated = [];

        foreach ($this->result as $key => $result){
            $validated[$key] = $result->value;
        }

        return $validated;
    }
}

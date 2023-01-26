<?php

namespace App\Modules\Validation\DTO;

class ValidateDTO
{
    public $value;
    public array $errors;
    public $line;
    public $field;
    public bool $isValid;

    /**
     * @param $value
     * @param array $errors
     * @param $line
     * @param $field
     * @param bool $isValid
     */
    public function __construct($value, array $errors, $line, $field, bool $isValid)
    {
        $this->value = $value;
        $this->errors = $errors;
        $this->line = $line;
        $this->field = $field;
        $this->isValid = $isValid;
    }
}

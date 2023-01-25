<?php

namespace App\Modules\Utils\Services;

class PasswordRandomService
{
    private array $alphasUpper;
    private array $alphasLower;
    private array $digits;
    private array $spec;

    public function __construct()
    {
        $this->alphasUpper = range('A', 'Z');
        $this->alphasLower = range('a', 'z');
        $this->digits = range('0', '9');
        $this->spec = ['-','_','%'];
    }

    public function handle()
    {
        $pass = [];
        $pass[] = $this->getValue($this->alphasUpper, 1);
        $pass[] = $this->getValue($this->alphasLower, 2);
        $pass[] = $this->getValue($this->digits, 5);
        $pass[] = $this->getValue($this->spec, 1);
        shuffle($pass);

        return implode('',$pass);
    }

    private function getValue(array $data, int $length)
    {
        shuffle($this->alphasUpper);
        shuffle($this->alphasLower);
        shuffle($this->digits);
        shuffle($this->spec);

        return implode('',array_slice($data, 0, $length));
    }
}

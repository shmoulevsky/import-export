<?php

namespace App\Modules\User\Services\Validation\Rules;

use Illuminate\Support\Facades\DB;

class UniqueRule
{
    private $name;
    private string $table;
    private string $column;

    public function __construct($name)
    {
        $info = explode(':', $name);
        $params = explode(',', $info[1]);
        $this->table = $params[0];
        $this->column = $params[1];
    }

    public function validate($value, $line, $field)
    {
        $count = DB::table($this->table)
            ->select('id')
            ->where($this->column, $value)
            ->count();

        if($count > 0){
            return "The field {$this->column} ({$value}) already exists in table {$this->table}. Line: {$line}";
        }

        return null;
    }
}

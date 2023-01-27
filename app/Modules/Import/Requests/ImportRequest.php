<?php

namespace App\Modules\Import\Requests;

use App\Modules\Import\Entities\ImportType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => ['required', Rule::in(array_keys(ImportType::getAll()))],
            'path' => ['required', 'string'],
        ];
    }
}

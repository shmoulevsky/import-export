<?php

namespace App\Modules\Export\Requests;

use App\Modules\Export\Entities\ExportType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type' => ['required', Rule::in(array_keys(ExportType::getAll()))],
        ];
    }
}

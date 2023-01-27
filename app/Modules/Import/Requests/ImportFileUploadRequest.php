<?php

namespace App\Modules\Import\Requests;

use App\Modules\Import\Entities\ImportType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImportFileUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => ['required', 'mimes:csv'],
        ];
    }
}

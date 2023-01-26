<?php

namespace App\Http\Controllers;

use App\Modules\Import\ImportService;
use App\Modules\Result\Services\ResultService;
use App\Modules\User\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ImportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private ResultService $resultService;

    public function __construct(
        ImportService $service,
        ResultService $resultService
    )
    {
        $this->service = $service;
        $this->resultService = $resultService;
    }

    public function import(Request $request)
    {
        $file = $request->file;

        if(!Storage::disk('public')->exists($file)){
           return response(['error' => "file not found: {$file}"], 422);
        }

        $model = User::class;
        $path = storage_path('app/public/').$file;

        $fields = [
            'user_name' => ['required','max:100','unique:users,user_name'],
            'first_name' => ['required','cyrillic','max:255'],
            'last_name' => ['required','cyrillic','max:255'],
            'patronymic' => ['cyrillic','max:255'],
            'email' => ['required','email'],
            'password' => ['required','password']
        ];

        $result = $this->resultService->add($request->type, $request->route());
        $this->service->handle($request->type, $path, $fields, $model, $result->id);
    }

}

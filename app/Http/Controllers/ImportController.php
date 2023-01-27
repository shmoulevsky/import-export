<?php

namespace App\Http\Controllers;

use App\Modules\Import\ImportService;
use App\Modules\Import\Requests\ImportRequest;
use App\Modules\Result\Services\ResultService;
use App\Modules\User\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

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

    public function import(ImportRequest $request)
    {
        $path = $request->path;

        /*if(!Storage::exists(basename($path))){
           return response(['error' => "file not found: {$path}"], 422);
        }*/

        $model = User::class;

        $fields = [
            'user_name' => ['required','max:100','unique:users,user_name'],
            'first_name' => ['required','cyrillic','max:255'],
            'last_name' => ['required','cyrillic','max:255'],
            'patronymic' => ['cyrillic','max:255'],
            'email' => ['required','email'],
            'password' => ['required','password']
        ];

        $result = $this->resultService->add($request->type, request()->path());
        $this->service->handle($request->type, $path, $fields, $model, $result->id);
        return response()->json(['status' => 'ok']);
    }

}

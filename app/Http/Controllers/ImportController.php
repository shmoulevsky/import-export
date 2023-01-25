<?php

namespace App\Http\Controllers;

use App\Modules\User\Models\User;
use App\Modules\User\Services\Import\ImportUserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class ImportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(ImportUserService $service)
    {
        $this->service = $service;
    }

    public function import(Request $request)
    {
        $path = $request->file;

        if(!Storage::disk('public')->exists($path)){
           return response(['error' => "file not found: {$path}"], 422);
        }

        $model = new User();

        $fields = ['user_name', 'first_name', 'last_name', 'patronymic', 'email', 'password'];
        $result = $this->service->handle($request->type, $path, $model);
    }

}

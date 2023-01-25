<?php

namespace App\Http\Controllers;

use App\Modules\User\Models\User;
use App\Modules\User\Services\Export\ExportUserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;


class ExportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private ExportUserService $service;

    public function __construct(ExportUserService $service)
    {
        $this->service = $service;
    }

    public function export(Request $request)
    {
        $path = storage_path()."/export-{$request->type}.csv";

        if(Storage::exists($path)){
            Storage::delete($path);
        }

        $model = new User();

        $fields = ['user_name', 'first_name', 'last_name', 'patronymic', 'email', 'password'];
        $result = $this->service->handle($request->type, $path, $fields, $model);
    }

}

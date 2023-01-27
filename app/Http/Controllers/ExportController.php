<?php

namespace App\Http\Controllers;

use App\Modules\Export\Entities\ExportType;
use App\Modules\Export\ExportService;
use App\Modules\Export\Requests\ExportRequest;
use App\Modules\Result\Entities\ResultStatus;
use App\Modules\Result\Services\ResultService;
use App\Modules\User\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class ExportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private ExportService $service;
    private ResultService $resultService;

    public function __construct(
        ExportService $service,
        ResultService $resultService
    )
    {
        $this->service = $service;
        $this->resultService = $resultService;
    }

    public function export(ExportRequest $request)
    {
        $path = storage_path("app/public")."/export-{$request->type}.csv";

        if(Storage::exists($path)){
            Storage::delete($path);
        }

        $model = User::class;
        $fields = ['user_name', 'first_name', 'last_name', 'patronymic', 'email', 'password'];

        $result = $this->resultService->add($request->type, request()->path());
        $this->service->handle($request->type, $path, $fields, $model, $result->id);

        return response()->json(['status' => 'ok']);
    }

    public function getTypes(Request $request)
    {
        $types = ExportType::getAll();
        return response()->json(['types' => $types]);
    }

}

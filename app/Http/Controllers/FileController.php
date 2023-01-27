<?php

namespace App\Http\Controllers;




use App\Modules\Import\Requests\ImportFileUploadRequest;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class FileController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private UserRepository $repository;

    public function upload(ImportFileUploadRequest $request)
    {
        $fileName = time().'.'.$request->file->extension();
        $request->file->move(storage_path('uploads/'), $fileName);
        return response()->json(['path' => storage_path('uploads/').$fileName]);
    }

}

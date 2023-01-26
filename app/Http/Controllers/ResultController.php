<?php

namespace App\Http\Controllers;

use App\Modules\Result\Repositories\ResultRepository;
use App\Modules\Result\Resources\ResultCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;

class ResultController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private ResultRepository $repository;

    public function __construct(ResultRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $results = $this->repository->all();
        return new ResultCollection($results);
    }

}

<?php

namespace App\Http\Controllers;


use App\Modules\Result\Repositories\ResultRepository;
use App\Modules\Result\Resources\ResultCollection;
use App\Modules\Utils\DTO\ParamListDTO;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


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
        $params = ParamListDTO::fromRequest($request);

        $results = $this->repository->all(
            $params->getSort(),
            $params->getDir(),
            $params->getCount()
        );
        return new ResultCollection($results);
    }

}

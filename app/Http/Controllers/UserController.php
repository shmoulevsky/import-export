<?php

namespace App\Http\Controllers;




use App\Modules\User\Repositories\UserRepository;
use App\Modules\User\Resources\UserCollection;
use App\Modules\Utils\DTO\ParamListDTO;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private UserRepository $repository;

    public function __construct(UserRepository $repository)
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
        return new UserCollection($results);
    }

}

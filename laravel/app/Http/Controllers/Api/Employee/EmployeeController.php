<?php

namespace App\Http\Controllers\Api\Employee;

use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends ApiController
{

    private UserService $userService;

    public function __construct(
        UserService       $userService,
    )
    {
        $this->userService = $userService;
    }

    public function listEmployees(Request $request): \Illuminate\Http\JsonResponse
    {
        $employees = $this->userService->search($request);
        $page_size = $request->page_size ?? $employees->count() ;
        $employees = $employees->paginate_simple($page_size);
        $data = EmployeeResource::collection($employees)->resource->toArray();
        $data_array=['employees'=>$data['data']];
        unset($data['data']);
        return $this->successShowPaginationResponse($data_array,$data, 'employee_list');
    }

}

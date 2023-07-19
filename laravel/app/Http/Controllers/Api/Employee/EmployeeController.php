<?php

namespace App\Http\Controllers\Api\Employee;

use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Employee\UpdateEmployeeRequest;
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, int $id): \Illuminate\Http\JsonResponse|array
    {

        $updated = $this->userService->update($request, $id);

        if ($updated) {
            $employee = $this->userService->find('id', $id);
            return $this->successUpdateWithContentResponse(EmployeeResource::make($employee));
        } else {
            return $this->failUpdateMessage();
        }
    }

}

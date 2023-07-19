<?php

namespace App\Http\Controllers\Api\Employee;

use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\Employee\UpdateEmployeeRequest;
use App\Http\Resources\CitiesResource;
use App\Http\Resources\EmployeeResource;
use App\Libraries\ApiResponse;
use App\Models\City;
use App\Models\User;
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $employee = $this->userService->find('id', $id);

        if (!$employee) {
            return $this->failResourceNotFoundMessage('employee');
        }

        $deleted = $this->userService->delete($employee);

        if (!$deleted) {
            return $this->failDeleteMessage();
        }

        return $this->successDeleteMessage();
    }

    public function getEmployee($search): \Illuminate\Http\Response
    {
        $employees = User::where('name','like','%'.$search.'%')
            ->orWhere('job_title','like','%'.$search.'%')
            ->get();

        return ApiResponse::success([
            'employees' => EmployeeResource::collection($employees)
        ]);
    }


}

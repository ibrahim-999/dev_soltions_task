<?php

namespace App\Domains\User\v1\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    private Model $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }
    public function registerUser($request): ?Model
    {
        try {
            return $this->userModel->create(
                [
                    'phone' => $this->getRequestPhone($request),
                    'name' => $request->name ?? null,
                    'email' => $request->email ?? null,
                    'password'=>bcrypt($request->password) ?? null,
                    'salary' => $request->salary ?? null,
                    'department' => $request->department ?? null,
                    'job_title' => $request->job_title ?? null,
                ]
            );
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
    public function getRequestPhone($request): ?string
    {
        try {
            if (is_array($request->phone)) {
                return phone($request->phone['number'], $request->phone['code'])->formatE164();
            }
            return phone($request->phone_number, $request->phone_code)->formatE164();
        } catch (\Throwable $exception) {
            throw $exception;
        }

    }
}

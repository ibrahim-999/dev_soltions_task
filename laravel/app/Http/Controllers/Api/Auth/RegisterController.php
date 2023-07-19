<?php

namespace App\Http\Controllers\Api\Auth;

use App\Domains\Shared\v1\Contracts\Services\OtpServiceContract;
use App\Domains\Shared\v1\Services\Auth\OtpAccessService;
use App\Domains\User\v1\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Libraries\ApiResponse;

class RegisterController extends Controller
{
    private UserService $userService;

    public function __construct(
        UserService      $userService,
    )
    {
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request){

        $user = $this->userService->registerUser($request);

        return ApiResponse::success([
            'token' => $user->createToken('register')->plainTextToken
        ]);
    }
}

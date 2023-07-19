<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Libraries\ApiResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            auth()->user()->tokens()->delete();
            return ApiResponse::success([
                'token' => auth()->user()->createToken('login')->plainTextToken
            ]);
        }
        return ApiResponse::fail('invalid credentials');
    }
}
<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\ApiFormRequest;

class LoginRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required','exists:users'],
            'password' => ['required']
        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}

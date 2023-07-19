<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\ApiFormRequest;
use App\Models\Driver;
use App\Models\User;
use App\Rules\DuplicatePhoneCheck;

class RegisterRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email'=>['required','unique:users','email'],
            'password'=>['required'],
            'confirm_password'=>['required','same:password'],
            'department' => ['required', 'string', 'max:255'],
            'job_title' => ['required', 'string', 'max:255'],
            'salary' => ['required', 'integer'],
            'phone.code' => ['required', 'string', 'max:2'],
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12', new DuplicatePhoneCheck(new User())],

        ];
    }
    public function authorize(): bool
    {
        return true;
    }
}

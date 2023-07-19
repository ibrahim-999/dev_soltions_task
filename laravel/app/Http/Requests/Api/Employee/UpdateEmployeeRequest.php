<?php

namespace App\Http\Requests\Api\Employee;

use App\Http\Requests\ApiFormRequest;
use App\Models\Driver;
use App\Models\User;
use App\Rules\DuplicateCustomPhoneCheck;

class UpdateEmployeeRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:users,email,'.request()->user()->id],
            'password'=>['nullable'],
            'department' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'salary' => ['nullable', 'integer'],
            'phone.code' => ['required', 'string', 'max:2'],
            'phone.number' => ['required', 'alpha_num', 'phone:phone.code', 'max:12', new DuplicateCustomPhoneCheck(new User(),request()->user()->id)],
        ];
    }

    public function messages()
    {
        return [
            'phone.number.phone' => __('messages.phone_match_country_code'),
        ];
    }
}

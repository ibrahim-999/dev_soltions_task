<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class checkPhoneExistence implements ValidationRule
{
    private $country_code;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($country_code)
    {
        $this->country_code = $country_code;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $phone = phone($value, $this->country_code)->formatE164();
        if (User::where('phone',$phone)->exists()) {
            $fail('The :attribute Already Exists');
        }
    }
}

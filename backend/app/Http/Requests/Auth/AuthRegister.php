<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AuthRegister extends BaseRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        "full_name" => ["required", "string", "max:255"],

        "phone_number" => [
            "required",
            "string",
            "max:20",
            "regex:/^[0-9+\-\s()]+$/",
            "unique:users,phone_number"
        ],

        "email" => [
            "required",
            "email",
            "max:255",
            "unique:users,email"
        ],

        "role" => [
            "required",
            "in:CLIENT,DRIVER"
        ],

        "password" => [
            "required",
            "string",
            "min:8",
            "max:255"
        ],

        'address' => [
            'required_if:role,CLIENT'
        ],

        'vehicle_type' =>[
             'required_if:role,DRIVER'
        ],
        ];
    }
}

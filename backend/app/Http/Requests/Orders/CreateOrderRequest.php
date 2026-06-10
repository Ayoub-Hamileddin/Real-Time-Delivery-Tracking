<?php

namespace App\Http\Requests\Orders;

use App\Http\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends BaseRequest
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
            "total_price" => ["required","numeric"],
            "delivery_address" => ["required","string"],
            "pickup_latitude" => ["required"],
            "pickup_longitude" => ["required"],
            "dropoff_latitude" => ["required"],
            "dropoff_longitude" => ["required"],
        ];
    }
}

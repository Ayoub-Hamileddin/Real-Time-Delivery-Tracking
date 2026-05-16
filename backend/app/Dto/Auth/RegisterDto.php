<?php

namespace App\Dto\Auth;

class RegisterDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $full_name,
        public string $phone_number,
        public string $email,
        public string $password,
        public string $role,
        public string $address,
        public ?string $vehicle_type,
    )
    {}

    public static function fromRequest($request){
        return new self(
            $request->full_name,
            $request->phone_number,
            $request->email,
            $request->password,
            $request->role,
            $request->address,
            $request->vehicle_type
        );
    }
}

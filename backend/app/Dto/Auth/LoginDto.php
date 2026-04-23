<?php

namespace App\Dto\Auth;

class LoginDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public string $password,
    )
    {
        //
    }

    public static function fromRequest($request){
        return new self(
            $request->email,
            $request->password
        );
    }
}

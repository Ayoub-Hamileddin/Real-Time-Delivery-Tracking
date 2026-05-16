<?php

namespace App\Dto\Auth;

class ResetPasswordDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public string $token,
        public string $password,
    )
    {
        //
    }

    public static function fromRequest($request){
        return new self(
            $request->email,
            $request->token,
            $request->password,
        );
    }
}

<?php

namespace App\Dto\Auth;

class ResetlinkDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
    )
    {
        //
    }

    public static function fromRequest($request){
        return new self(
            $request->email,
        );
    }
}

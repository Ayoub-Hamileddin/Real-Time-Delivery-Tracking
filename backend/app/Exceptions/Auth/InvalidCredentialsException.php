<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseApiException;


class InvalidCredentialsException extends BaseApiException
{

    public function __construct()
    {
        return parent::__construct(
            message   : "invalid credentials",
            status    :  401,
            erroreCode: "AUTH_INVALID_CREDENTIALS");
    }
}

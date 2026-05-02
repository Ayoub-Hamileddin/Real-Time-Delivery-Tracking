<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseApiException;
use Exception;

class EmailAlreadyExistException extends BaseApiException
{
    public function __construct()
    {
        return parent::__construct(
            message   : "Email already Exist",
            status    :  409,
            erroreCode: "EAMIL_ALREADY_EXIST");
    }
}

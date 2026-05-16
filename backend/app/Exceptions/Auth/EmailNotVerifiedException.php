<?php

namespace App\Exceptions\Auth;

use App\Exceptions\BaseApiException;

class EmailNotVerifiedException extends BaseApiException
{
    public function __construct()
    {
        return parent::__construct(
            message   : "Email not verified",
            status    :  403,
            erroreCode: "EMAIL_NOT_VERIFIED");
    }
}

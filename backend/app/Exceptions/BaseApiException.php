<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Override;

class BaseApiException extends Exception
{
    protected  int $status;
    protected  string $errorCode;
    protected  array $errors;

    public function __construct(
        string $message = "Something went wrong",
        int $status = 400,
        string $erroreCode = "GENERAL_ERROR",
        array $errors = []

    )
    {
        parent::__construct($message);

        $this->status = $status;
        $this->errorCode = $erroreCode;
        $this->errors = $errors;
    }

    public function render(){
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'error_code' => $this->errorCode,
            'errors' => $this->errors,
        ], $this->status);
    }

}

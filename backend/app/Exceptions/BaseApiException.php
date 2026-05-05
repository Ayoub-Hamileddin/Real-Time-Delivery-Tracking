<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;
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

    public function render($request,Throwable $e){

        Log::error("Unhandled exception",[
            "message" =>$e->getMessage(),
            "file" =>$e->getFile(),
            "line" =>$e->getLine(),
        ]);

        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
            'error_code' => $this->errorCode,
            'errors' => $this->errors,
        ], $this->status);
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\RegisterDto;
use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLogin;
use App\Http\Requests\Auth\AuthRegister;
use App\Http\Resources\UserRessource;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }


    public function register(AuthRegister $request){
        try {
            $dto = RegisterDto::fromRequest($request);
            $response = $this->authService->authRegister($dto);

            return ApiResponse::success("register successfuly",new UserRessource($response),"success",200);

        } catch (\Throwable $e) {
            Log::error("Error : something wrong in registrations ".$e->getMessage());
            return ApiResponse::error("Error while registering","error",500);
        }
    }

    public function login(AuthLogin $request){
        try {
            $dto = LoginDto::fromRequest($request);
            $response = $this->authService->authLogin($dto);
            return ApiResponse::success("login successfuly",$response,"success",200);
        } catch (\Throwable $e) {
            Log::error("Error : something wrong in logging ".$e->getMessage());
            return ApiResponse::error("Error while logging","error",500);
        }
    }
}

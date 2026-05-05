<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\LoginDto;
use App\Dto\Auth\RegisterDto;
use App\Dto\Auth\ResetlinkDto;
use App\Dto\Auth\ResetPasswordDto;
use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLogin;
use App\Http\Requests\Auth\AuthRegister;
use App\Http\Requests\ResetlinkRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserRessource;
use App\Services\AuthService;
use Backend\App\Helper\AuthHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    private AuthService $authService;
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }


    public function register(AuthRegister $request){

            AuthHelper::rateLimiting($request);

            $dto = RegisterDto::fromRequest($request);
            $response = $this->authService->authRegister($dto);

            return ApiResponse::success("register successfuly",new UserRessource($response),"success",200);

    }

    public function login(AuthLogin $request){
            AuthHelper::rateLimiting($request);

            $dto = LoginDto::fromRequest($request);
            $response = $this->authService->authLogin($dto);

            return ApiResponse::success("login successfuly",$response,"success",200);
    }

    public function logout(Request $request){
        $this->authService->authLogout($request);
        return ApiResponse::success("Logout successfuly",null,"success",204);
    }


    public function verifiedEmail(Request $request){

        $this->authService->verifiedEmail($request);
        return ApiResponse::success("Email verified successfuly");
    }

    public function resendEmail(Request $request){

        $this->authService->resendEmail($request);
        return ApiResponse::success("Verification email sent");
    }

    public function forgetPassword(ResetlinkRequest $request){

        $dto = ResetlinkDto::fromRequest($request);
        $this->authService->forgetPasswordLink($dto);
    }


    public function resetPassword(ResetPasswordRequest $request){

        $dto = ResetPasswordDto::fromRequest($request);
        $this->authService->resetPassword($dto);
    }

}

<?php
namespace Backend\App\Helper;

use App\Helper\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthHelper{

    public static function rateLimiting($request){
        $key = "login-".$request->ip();

        if (RateLimiter::tooManyAttempts($key,5)) {
            return ApiResponse::error("To many Attempts","error",429);
        }
        RateLimiter::hit($key,60);
    }

    public  static function checkUserCredentials($user,$dto){
        if (!$user->hasVerifiedEmail()) {
            throw new Exception("Email not verified");
        }
        if (!$user || !Hash::check($dto->password,$user->password)) {
            throw new Exception("Invalids credentials");
        }
    }
}

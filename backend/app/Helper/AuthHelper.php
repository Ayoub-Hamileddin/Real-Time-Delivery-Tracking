<?php
namespace App\Helper;

use App\Exceptions\Auth\EmailNotVerifiedException;
use App\Exceptions\Auth\InvalidCredentialsException;
use App\Helper\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class AuthHelper{

    public static function rateLimiting($request){
        $ip  = $request->ip();
        $key = "login-".$ip;

        if (RateLimiter::tooManyAttempts($key,5)) {

            Log::channel('auth')->warning(
                'Rate limiting exceeded',[
                'ip' => $ip,
                'email' => $request->input('email'),
            ]);

            return ApiResponse::error("To many Attempts","error",429);
        }
        RateLimiter::hit($key,60);
    }

    public  static function  checkUserCredentials($user,$dto){
        if (!$user->hasVerifiedEmail()) {
            throw new EmailNotVerifiedException();
        }
        if (!$user || !Hash::check($dto->password,$user->password)) {

            Log::channel('auth')->warning(
                "Failed auth login",[
                'ip' => request()->ip(),
                'email' => $dto->email,
            ]);

            throw new InvalidCredentialsException();
        }
    }
}

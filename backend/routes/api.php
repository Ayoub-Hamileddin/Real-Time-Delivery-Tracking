<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function(){
    Route::prefix("/auth")->name("auth.")->group(function(){
        // Guset auth endpoints
        Route::middleware("guest")->group(function(){

            Route::post("register","register")
                ->name("register");

            Route::post("login","login")
                ->name("login");

            Route::post("/forget-password","forgetPassword")
                ->name("password.request");
        });

        Route::middleware("auth:api")->group(function(){

            Route::post("logout","logout")
                ->name("logout");

            Route::post("/email/verify/{id}/{hash}","verifiedEmail")
                ->name("verificationEmail");

            Route::post('/email/resend',"resendEmail");

            Route::post("reset-password","resetPassword")
                ->name("password.update");
        });

    });
});

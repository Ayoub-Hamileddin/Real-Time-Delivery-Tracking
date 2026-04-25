<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function(){
    Route::prefix("/auth")->name("auth.")->group(function(){
        Route::post("register","register")->name("register");
        Route::post("login","login")->name("login");
        Route::post("logout","logout")
            ->middleware("auth:api")
            ->name("logout");
    });
});

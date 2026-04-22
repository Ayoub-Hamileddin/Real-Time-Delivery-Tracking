<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::controller(AuthController::class)->group(function(){
    Route::prefix("/auth")->name("auth.")->group(function(){
        Route::post("register","register")->name("register");
    });
});

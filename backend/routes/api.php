<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

use App\Services\Prometheus\PrometheusService;
use Prometheus\RenderTextFormat;



/**
 *  Auth routes from api/auth.php
*/
Route::group([],__DIR__.'/api/auth.php');
Route::group([],__DIR__.'/api/orders.php');
Route::group([],__DIR__.'/api/tasks.php');



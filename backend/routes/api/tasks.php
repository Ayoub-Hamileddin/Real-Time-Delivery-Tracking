<?php

use App\Http\Controllers\Task\DeliveryTaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource("/tasks",DeliveryTaskController::class)
->middleware(["auth:api"]);

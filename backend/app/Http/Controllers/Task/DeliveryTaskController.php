<?php

namespace App\Http\Controllers\Task;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryTaskResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class DeliveryTaskController extends Controller
{
    private readonly TaskService $taskService;

    public function __construct(
        TaskService $taskService
    ){
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskService->tasks();
        return ApiResponse::success("tasks",new DeliveryTaskResource($tasks),"sucess",200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

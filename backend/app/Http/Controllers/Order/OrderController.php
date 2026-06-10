<?php

namespace App\Http\Controllers\Order;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\User;
use App\Repository\AuthRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private readonly AuthRepository $authRepository;
    private readonly OrderService $orderService;

    public function __construct(
        AuthRepository $authRepository,
        OrderService $orderService
    ){
        $this->authRepository = $authRepository;
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $response = $this->orderService->createOrder($request);
        return ApiResponse::success("order create succesfuly",$response,"sucess",201);
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

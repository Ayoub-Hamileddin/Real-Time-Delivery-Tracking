<?php

namespace App\Services;

use App\Enum\OrderStatus;
use App\Enum\TaskStatus;
use App\Http\Resources\DeliveryTaskResource;
use App\Http\Resources\OrderResource;
use App\Repository\DeliveryTaskRepository;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{

    private readonly OrderRepository $orderRepository;
    private readonly DeliveryTaskRepository $deliveryTaskRepository;

    public function __construct(
        OrderRepository $orderRepository,
        DeliveryTaskRepository $deliveryTaskRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->deliveryTaskRepository = $deliveryTaskRepository;
    }


    public function createOrder($request){
        $user = $request->user();
        return DB::transaction(function()use ($user,$request){
            $dataOrder = [
                'client_id' => $user->id,
                'total_price' => $request->total_price,
                'delivery_address' => $request->delivery_address,
                "status" => OrderStatus::CREATED,
            ];

            $order =  $this->orderRepository->create($dataOrder);

            Log::channel("order")->warning("check variable order",[
                "order"=>$order,
                "dataOrder"=>$dataOrder,
            ]);
            $dataTask = [
                "order_id" => $order->id,
                "pickup_latitude" => $request->pickup_latitude,
                "pickup_longitude" => $request->pickup_longitude,
                "dropoff_latitude" => $request->dropoff_latitude,
                "dropoff_longitude" => $request->dropoff_longitude,
                "status" => TaskStatus::Pending,
            ];
            $task = $this->deliveryTaskRepository->createTask($dataTask);

            Log::channel("task")->warning("check variable delivery task",[
                "task"=>$task,
                "dataTask"=>$dataTask,
            ]);
            return [
                'order' => new OrderResource($order),
                'task' => new DeliveryTaskResource($task),
            ];
        });

    }
}

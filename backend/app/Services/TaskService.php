<?php

namespace App\Services;

use App\Repository\DeliveryTaskRepository;

class TaskService
{
   private readonly DeliveryTaskRepository $deliveryTaskRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(
        DeliveryTaskRepository $deliveryTaskRepository
    )
    {
        $this->deliveryTaskRepository = $deliveryTaskRepository;
    }


    public function tasks(){
        return $this->deliveryTaskRepository->getAll();
    }
}

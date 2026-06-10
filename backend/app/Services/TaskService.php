<?php

namespace App\Services;

use App\Models\DeliveryTask;
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

    public function findTaskById(string $id){
        return $this->deliveryTaskRepository->findById($id);
    }
}

<?php

namespace App\Repository;

use App\Models\DeliveryTask;

class DeliveryTaskRepository
{


    public function createTask($data){
        return DeliveryTask::create($data);
    }

    public function getAll(){
        return DeliveryTask::paginate(10);
    }

}

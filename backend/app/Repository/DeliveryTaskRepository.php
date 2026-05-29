<?php

namespace App\Repository;

use App\Enum\TaskStatus;
use App\Models\DeliveryTask;

class DeliveryTaskRepository
{


    public function createTask($data){
        return DeliveryTask::create($data);
    }

    public function getAll(){
        return DeliveryTask::
            where("status",TaskStatus::Pending)
            ->paginate(10);
    }

    public function findById($id){
        return DeliveryTask::where("id",$id)
        ->first();
    }

}

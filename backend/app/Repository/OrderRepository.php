<?php

namespace App\Repository;

use App\Models\Order;

class OrderRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function create($data){
        return Order::create($data);
    }
}

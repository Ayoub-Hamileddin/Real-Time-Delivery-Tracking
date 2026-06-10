<?php

namespace App\Enum;

enum TaskStatus :string
{
    case Pending="Pending";
    case Picked_up="Picked_up";
    case In_transit="In_transit";
    case Delivered="Delivered";
    case Failed="Failed";
}

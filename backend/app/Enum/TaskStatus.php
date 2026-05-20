<?php

namespace App\Enum;

enum TaskStatus
{
    case Pending;
    case Picked_up;
    case In_transit;
    case Delivered;
    case Failed;
}

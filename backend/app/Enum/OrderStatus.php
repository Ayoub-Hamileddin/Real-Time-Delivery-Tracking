<?php

namespace App\Enum;

enum OrderStatus :string
{
    case CREATED = "CREATED";
    case PAID = "PAID";
    case CANCELLED = "CANCELLED";
}

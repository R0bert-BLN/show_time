<?php

namespace App\Enum;

enum BookingStatus: string
{
    case CONFIRMED = 'confirmed';
    case CANCELLED = 'cancelled';
    case PENDING = 'pending';
    case EXPIRED = 'expired';
}

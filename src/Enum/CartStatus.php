<?php

namespace App\Enum;

enum CartStatus: string
{
    case ORDERED = 'ordered';
    case ACTIVE = 'active';
}

<?php

namespace App\Enums\CartManagement;

enum CartQuantityAction: string
{
    case INCREMENT = 'increment';
    case DECREMENT = 'decrement';
}

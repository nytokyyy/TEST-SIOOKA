<?php

namespace App\Exceptions\CartManagement;

use Exception;

class CartItemNotFoundException extends Exception
{
    protected $message = 'The specified product is not in the cart.';
}

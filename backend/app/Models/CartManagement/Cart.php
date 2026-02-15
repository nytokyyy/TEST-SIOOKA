<?php

namespace App\Models\CartManagement;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['session_id', 'user_id'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function total(): float
    {
        return (float) (
            $this->cartItems()
                ->join('products', 'cart_items.product_id', '=', 'products.id')
                ->selectRaw('SUM(cart_items.quantity * products.price) as total')
                ->value('total') ?? 0
        );
    }
}

<?php

namespace App\Models\CartManagement;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}

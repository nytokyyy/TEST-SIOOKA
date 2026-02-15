<?php

namespace App\Services\CartManagement;

use App\Models\CartManagement\Cart;
use App\Models\CartManagement\Product;
use Illuminate\Http\Request;

class CartService
{
    public function addProductToCart(Cart $cart, Product $product, $quantity = 1): Cart
    {
        $cartItem = $cart->cartItems()
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cart->cartItems()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return $cart->load('cartItems.product');
    }

    public function removeProductFromCart(Cart $cart, Product $product): Cart
    {
        $cartItem = $cart->cartItems()
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return $cart->load('cartItems.product');
    }

    public function getCurrentCart(Request $request): Cart
    {
        $user = $request->user('sanctum');
        if ($user) {
            return Cart::firstOrCreate([
                'user_id' => $user->id,
            ]);
        }

        // For guests, we can use session ID to track their cart
        $sessionId = session()->getId();

        return Cart::firstOrCreate([
            'session_id' => $sessionId,
        ]);
    }
}

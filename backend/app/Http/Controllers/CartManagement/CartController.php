<?php

namespace App\Http\Controllers\CartManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartManagement\AddToCartRequest;
use App\Http\Resources\CartManagement\CartResource;
use App\Models\CartManagement\Product;
use App\Services\CartManagement\CartService;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    )
    {
    }

    public function show(): CartResource      
    {
        $cart = $this->cartService->getCurrentCart();

        return new CartResource($cart->load('cartItems.product'));
    }

    public function addProduct(AddToCartRequest $request): CartResource
    {
        $cart = $this->cartService->getCurrentCart();
        $product = Product::findOrFail($request->product_id);

        $cart = $this->cartService->addProductToCart(
            $cart,
            $product,
            $request->quantity ?? 1
        );

        return new CartResource($cart);
    }

    public function removeProduct(Product $product): CartResource
    {
        $cart = $this->cartService->getCurrentCart();

        $cart = $this->cartService->removeProductFromCart($cart, $product);

        return new CartResource($cart);
    }
}

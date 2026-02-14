<?php

namespace App\Http\Controllers\CartManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartManagement\AddToCartRequest;
use App\Http\Resources\CartManagement\CartResource;
use App\Models\CartManagement\Product;
use App\Services\CartManagement\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    )
    {
    }

    public function show(Request $request)
    {
        $cart = $this->cartService->getCurrentCart($request);

        return new CartResource($cart->load('cartItems.product'));
    }

    public function addProduct(AddToCartRequest $request)
    {
        $cart = $this->cartService->getCurrentCart($request);
        $product = Product::findOrFail($request->product_id);

        $cart = $this->cartService->addProductToCart(
            $cart,
            $product,
            $request->quantity ?? 1
        );

        return new CartResource($cart);
    }

    public function removeProduct(Product $product, Request $request)
    {
        $cart = $this->cartService->getCurrentCart($request);

        $cart = $this->cartService->removeProductFromCart($cart, $product);

        return new CartResource($cart);
    }
}

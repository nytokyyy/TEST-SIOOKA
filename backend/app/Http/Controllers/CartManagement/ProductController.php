<?php

namespace App\Http\Controllers\CartManagement;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartManagement\ProductResource;
use App\Models\CartManagement\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): ResourceCollection
    {
        $perPage = $request->integer('per_page', 10);

        $products = Product::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return ProductResource::collection($products);
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}

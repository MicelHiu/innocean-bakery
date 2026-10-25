<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(Store $store)
    {
        return ProductResource::collection(
            Product::where('tier_id', $store->tier_id)->orderBy('product_name')->get()
        );
    }

    public function all()
    {
        return ProductResource::collection(
            Product::orderBy('product_id')->get()
        );
    }
}

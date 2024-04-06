<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductInfoResource;
use App\Http\Resources\ProductResource;
use App\Models\Essence;
use App\Models\Product;
use App\Models\SubEssence;
use App\Services\ProductService;

class ProductController extends BaseApiController
{
    public function show(Essence $essence, SubEssence $subEssence, Product $product)
    {
        return response()->json([
            'product' => ProductResource::make($product),
            'info' => ProductInfoResource::make($product->subEssences),
        ]);
    }
}

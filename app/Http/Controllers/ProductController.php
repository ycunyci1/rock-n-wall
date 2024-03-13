<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $service = app(ProductServiceInterface::class);
        $products = $service->getMainPageInfo();

        return response()->json($products);
    }
}

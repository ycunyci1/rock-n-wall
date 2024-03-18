<?php

namespace App\Http\Controllers;

use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = app(ProductServiceInterface::class)->getMainPageInfo();

        return response()->json($products);
    }
}

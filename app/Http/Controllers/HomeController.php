<?php

namespace App\Http\Controllers;

use App\Services\ProductService;

class HomeController extends BaseApiController
{
    public function index()
    {
        return response()->json(app(ProductService::class)->getMainPageInfo());
    }
}

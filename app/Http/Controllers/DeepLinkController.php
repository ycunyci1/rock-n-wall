<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeepLinkController extends Controller
{
    public function __invoke($subEssenceId, $productId)
    {
        return redirect('https://play.google.com/store/apps/details?id=com.ddone.wallpapers');
    }
}

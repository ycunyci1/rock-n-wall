<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeepLinkController extends Controller
{
    public function base($subEssenceId, $productId)
    {
        return true;
//        return redirect('https://play.google.com/store/apps/details?id=com.ddone.wallpapers');
    }

    public function live($productId)
    {
        return redirect('https://play.google.com/store/apps/details?id=com.ddone.wallpapers');
    }
}

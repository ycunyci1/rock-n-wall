<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function responseJson(mixed $response = [], $status = 200)
    {
        return response()->json($response, $status);
    }
}

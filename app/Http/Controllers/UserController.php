<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class UserController extends BaseApiController
{
    public function index()
    {
        return $this->responseJson(UserResource::make(auth()->user()));
    }
}

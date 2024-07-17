<?php

namespace App\Http\Controllers;

use App\Models\User;

class TempController extends BaseApiController
{
    //todo: Удалить после интеграции с мобильным разработчиком
    public function login()
    {
        $user = User::query()->first();

        return response()->json([
            'token' => $user->createToken('AUTO_TOKEN')->accessToken,
        ]);
    }
}

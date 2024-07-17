<?php

namespace App\Http\Controllers;

use App\DTO\Resources\UserDTO;
use Illuminate\Http\JsonResponse;

class UserController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/api/v1/user-info",
     *     summary="Получить информацию о текущем пользователе",
     *     tags={"Other"},
     *
     *     @OA\Response(
     *          response=200,
     *          description="Информация о пользователе",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/User"
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     */
    public function index(): JsonResponse
    {
        return $this->responseJson(UserDTO::from(auth()->user()));
    }
}

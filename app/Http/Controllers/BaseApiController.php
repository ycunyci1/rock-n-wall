<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Rock-n-wall api",
 *      description="Documentation Rock-n-wall API",
 * )
 *
 * @OA\Tag(
 *     name="Pages",
 *     description="Информация для отдельных страниц"
 * )
 * @OA\Tag(
 *     name="Favorite",
 *     description="Маршруты для избранного"
 * )
 * @OA\Tag(
 *     name="Paginate",
 *     description="Пагинация"
 * )
 * @OA\Tag(
 *     name="Other",
 *     description="Остальное"
 * )
 *
 * @OA\Server(
 *      url="http://5.35.83.190",
 *      description="Debug test server"
 * )
 *
 * @OA\Server(
 *      url="https://wallpapers-ddone.com",
 *      description="Production server"
 * )
 *
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="auth_api",
 *     name="app-key"
 * )
 */
class BaseApiController extends Controller
{
    public function responseJson(mixed $response = [], $status = 200)
    {
        return response()->json($response, $status);
    }
}

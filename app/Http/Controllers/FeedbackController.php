<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedbackController extends BaseApiController
{
    /**
     * @OA\Post(
     *     path="/api/v1/rating",
     *     summary="Отправить фидбэк",
     *     tags={"Other"},
     *
     *     @OA\Parameter(
     *          name="rating",
     *          description="Оценка от 1 до 5",
     *          in="query",
     *          required=true,
     *          example="5",
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="description",
     *          description="Описание",
     *          in="query",
     *          required=false,
     *          example="Все очень понравилось!",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=201,
     *          description="Успешно добавлено",
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Ошибка сервера",
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $feedbackData = $request->validate([
            'rating' => 'required|int|max:5|min:1',
            'description' => 'nullable'
        ]);
        Feedback::query()->create($feedbackData);
        return response()->json(['message' => 'Успешно отправлено!'], 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Enum\ReportTypeEnum;
use App\Models\Report;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReportController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/reports",
     *     summary="Отправить жалобу",
     *     tags={"Other"},
     *
     *     @OA\Parameter(
     *          name="type",
     *          description="Тип жалобы",
     *          in="query",
     *          required=true,
     *          example="found_bug/rights/other",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Email",
     *          in="query",
     *          required=true,
     *          example="test@example.com",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *     ),
     *     @OA\Parameter(
     *          name="comment",
     *          description="Текст жалобы",
     *          in="query",
     *          required=true,
     *          example="Почему-то галочку нажимаю, а она не нажимается",
     *          @OA\Schema(
     *              type="string",
     *          ),
     *     ),
     *     @OA\Response(
     *          response=204,
     *          description="Успешно отправлено",
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
        $reportData = $request->validate([
            'type' => ['required', Rule::in(ReportTypeEnum::values())],
            'email' => 'email|required',
            'comment' => 'string|required|min:3',
        ]);
        Report::query()->create($reportData);
        return response()->json([], 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\DTO\Resources\ProductDTO;
use App\DTO\Resources\SubEssenceShowDTO;
use App\Http\Requests\PaginateRequest;
use App\Models\Essence;
use App\Models\SubEssence;
use App\Services\SubEssenceService;
use Illuminate\Http\JsonResponse;

class SubEssenceController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/api/v1/essences/{essenceId}/sub-essences/{subEssenceId}",
     *     summary="Получить детальные данные для страницы sub essence",
     *     tags={"Pages"},
     *
     *     @OA\Parameter(
     *          name="essenceId",
     *          description="Essence id",
     *          in="path",
     *          required=true,
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Parameter(
     *          name="subEssenceId",
     *          description="Sub essence id",
     *          in="path",
     *          required=true,
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Данные для детальной страницы sub essence",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/SubEssenceShow"
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function show(Essence $essence, SubEssence $subEssence)
    {
        return response()->json(SubEssenceShowDTO::from($subEssence->load('products')));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/essences/{essenceId}/sub-essences/{subEssenceId}/paginate",
     *     summary="Пагинация изображений на детальной странице subEssence",
     *     tags={"Paginate"},
     *
     *     @OA\Parameter(
     *          name="essenceId",
     *          description="Essence id",
     *          in="path",
     *          required=true,
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Parameter(
     *          name="subEssenceId",
     *          description="Sub essence id",
     *          in="path",
     *          required=true,
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Последний или первый id изображения в текущем sub essence (первый если надо предыдущие получить, последний если следующие)",
     *          in="query",
     *          required=true,
     *          example="1",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Parameter(
     *          name="need",
     *          description="Необходимо получить следующие или предыдущие",
     *          in="query",
     *          required=true,
     *          example="next/prev",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Следующие или предыдущие изображения на странице sub essence",
     *
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Product")
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function paginate(Essence $essence, SubEssence $subEssence, PaginateRequest $request)
    {
        $data = $request->validated();
        $products = app(SubEssenceService::class)->paginate($subEssence, $data);

        return response()->json(ProductDTO::collect($products));
    }
}

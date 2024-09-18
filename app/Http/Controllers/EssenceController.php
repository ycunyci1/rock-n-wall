<?php

namespace App\Http\Controllers;

use App\DTO\Resources\SubEssenceDTO;
use App\Http\Requests\PaginateRequest;
use App\Models\Essence;
use App\Services\EssenceService;
use Illuminate\Http\JsonResponse;

class EssenceController extends BaseApiController
{
    private EssenceService $service;

    public function __construct(EssenceService $categoryService)
    {
        $this->service = $categoryService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/essences/{essenceId}",
     *     summary="Получить детальные данные для страницы essence",
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
     *     @OA\Response(
     *          response=200,
     *          description="Данные для детальной страницы essence",
     *
     *          @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(ref="#/components/schemas/SubEssence")
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function show(Essence $essence)
    {
        return response()->json(SubEssenceDTO::collect($essence->subEssences()->orderBy('sort')->orderBy('id')->take(30)->get()));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/essences/{essenceId}/paginate",
     *     summary="Пагинация для детальной страницы essence",
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
     *          name="id",
     *          description="Последний или первый id subEssence в текущем essence (первый если надо предыдущие получить, последний если следующие)",
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
     *          description="Данные для детальной страницы essence",
     *
     *          @OA\JsonContent(
     *              type="array",
     *
     *              @OA\Items(ref="#/components/schemas/SubEssence")
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function paginate(PaginateRequest $request, Essence $essence)
    {
        $data = $request->validated();
        $subEssences = $this->service->paginate($data, $essence);

        return response()->json(SubEssenceDTO::collect($subEssences));
    }
}

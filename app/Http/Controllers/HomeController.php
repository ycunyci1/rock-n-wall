<?php

namespace App\Http\Controllers;

use App\DTO\Resources\EssenceDTO;
use App\DTO\Resources\MainPageDTO;
use App\DTO\Resources\ProductDTO;
use App\Models\Essence;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class HomeController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/api/v1/main",
     *     summary="Получить данные для главной страницы",
     *     tags={"Pages"},
     *
     *     @OA\Response(
     *          response=200,
     *          description="Данные для главной страницы",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/MainPageData"
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(
            new MainPageDTO(
                liveImages: ProductDTO::collect(Product::query()->orderBy('sort')->where('live', 1)->take(30)->get()),
                essences: EssenceDTO::collect(Essence::with('subEssences')->orderBy('sort')->get())
            )
        );
    }
}

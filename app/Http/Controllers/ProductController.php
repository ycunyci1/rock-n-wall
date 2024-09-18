<?php

namespace App\Http\Controllers;

use App\DTO\Resources\AiPromptDTO;
use App\DTO\Resources\ProductDTO;
use App\DTO\Resources\ProductInfoDTO;
use App\DTO\Resources\ProductShowDTO;
use App\DTO\Resources\EssenceDTO;
use App\DTO\Resources\EssenceShortDTO;
use App\Models\Essence;
use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/api/v1/essences/{essenceId}/sub-essences/{subEssenceId}/products/{productId}",
     *     summary="Получить данные для детальной страницы изображения",
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
     *     @OA\Parameter(
     *          name="productId",
     *          description="Product id",
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
     *          description="Данные для детальной страницы изображения",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ProductShow"
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     */
    public function show(Essence $essence, SubEssence $subEssence, Product $product): JsonResponse
    {
        return response()->json(ProductShowDTO::from([
                'product' => ProductDTO::from($product->toArray()),
                'info' => ProductInfoDTO::collect($product->subEssences),
                'promptDetail' => $product->aiPrompt ? AiPromptDTO::from($product->aiPrompt->toArray()) : null
            ]
        ));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/products/{productId}",
     *     summary="Получить данные для детальной страницы изображения",
     *     tags={"Pages"},
     *
     *     @OA\Parameter(
     *          name="productId",
     *          description="Product id",
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
     *          description="Данные для детальной страницы изображения",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/ProductShow"
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     */
    public function shortShow(Product $product): JsonResponse
    {
        $subEssences = $product->subEssences;
        $essences = $subEssences->map(fn($subEssence) => $subEssence->essence->load('subEssences'));
        return response()->json(ProductShowDTO::from([
                'product' => ProductDTO::from($product->toArray()),
                'info' => ProductInfoDTO::collect($product->subEssences),
                'essences' => EssenceShortDTO::collect($essences),
                'promptDetail' => $product->aiPrompt ? AiPromptDTO::from($product->aiPrompt->toArray()) : null
            ]
        ));
    }
}

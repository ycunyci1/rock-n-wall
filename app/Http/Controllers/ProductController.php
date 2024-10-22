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
use Illuminate\Http\Request;

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
                'share_url' => route('deep-link', ['subEssenceId' => $subEssence->id, 'productId' => $product->id]),
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
                'share_url' => route('deep-link', ['subEssenceId' => $subEssences->first()->id, 'productId' => $product->id]),
                'product' => ProductDTO::from($product->toArray()),
                'info' => ProductInfoDTO::collect($product->subEssences),
                'essences' => EssenceShortDTO::collect($essences),
                'promptDetail' => $product->aiPrompt ? AiPromptDTO::from($product->aiPrompt->toArray()) : null
            ]
        ));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/live-images",
     *     summary="Получить живые обои",
     *     tags={"Pages"},
     *
     *     @OA\Parameter(
     *          name="page",
     *          description="Страница пагинации",
     *          in="query",
     *          required=false,
     *          example="2",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Полученные живые обои",
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
     */
    public function liveImages(Request $request)
    {
        if ($request->get('page')) {
            $productsQuery = Product::where('live', 1)->orderBy('sort')->orderBy('id');
            $page = $request->get('page');
            $products = $productsQuery
                ->skip(($page - 1) * 30)
                ->take(30)
                ->get();
        }else {
            $products = Product::where('live', 1)->orderBy('sort')->orderBy('id')->take(30)->get();
        }
        return ProductDTO::collect($products);
    }
}

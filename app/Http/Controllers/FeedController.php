<?php

namespace App\Http\Controllers;

use App\DTO\Resources\ProductDTO;
use App\Http\Requests\FeedRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Product;
use App\Services\FeedService;
use Illuminate\Http\JsonResponse;

class FeedController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/api/v1/feed",
     *     summary="Получить данные для страницы бесконечной ленты",
     *     tags={"Pages"},
     *
     *     @OA\Parameter(
     *          name="type",
     *          description="Тип ленты",
     *          in="query",
     *          required=true,
     *          example="all/new/popular",
     *
     *          @OA\Schema(
     *              type="string",
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="Данные для бесконечной ленты",
     *
     *          @OA\JsonContent(
     *              type="array",
     *
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
    public function show(FeedRequest $request)
    {
        $data = $request->validated();
        if (! isset($data['type'])) {
            $data['type'] = 'all';
        }
        $feed = app(FeedService::class)->show($data);

        return response()->json(ProductDTO::collect($feed));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/feed/paginate",
     *     summary="Пагинация для бесконечной ленты",
     *     tags={"Paginate"},
     *
     *     @OA\Parameter(
     *          name="type",
     *          description="Тип ленты",
     *          in="query",
     *          required=true,
     *          example="all/new/popular",
     *
     *          @OA\Schema(
     *              type="integer",
     *          ),
     *     ),
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Последний или первый id изображения в ленте (первый если надо предыдущие получить, последний если следующие)",
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
     *          description="Следующие или предыдущие изображения для бесконечной ленты",
     *
     *          @OA\JsonContent(
     *              type="array",
     *
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
    public function paginate(PaginateRequest $request)
    {
        $data = $request->validated();
        if (! isset($data['type'])) {
            $data['type'] = 'all';
        }
        $products = app(FeedService::class)->paginate($data);

        return response()->json(ProductDTO::collect($products));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/search",
     *     summary="Поиск (Поиск реализован по названию изображений и тэгам - они невидимы для пользователей и служат для группировки изображений)",
     *     tags={"Other"},
     *     @OA\Parameter(
     *          name="query",
     *          description="Строка поиска",
     *          in="query",
     *          required=true,
     *          example="animals",
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Найденные изображения",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="items",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Product")
     *              ),
     *              @OA\Property(
     *                  property="status",
     *                  type="string"
     *              )
     *          )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function search(SearchRequest $request)
    {
        $data = $request->validated();
        $searchTerm = $data['query'];
        // todo: Вынести в сервис
        $result = Product::query() 
            ->where('name', 'LIKE', "%$searchTerm%")
            ->orWhereHas('tags', fn ($query) => $query->where('name', 'LIKE', "%$searchTerm%")
            )->get();

        return response()->json([
            'items' => ProductDTO::collect($result),
            'status' => 'success',
            'count' => $result->count()
            ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\DTO\Resources\FavoriteDTO;
use App\Models\Product;
use App\Models\SubEssence;
use App\Services\FavoriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FavoriteController extends BaseApiController
{
    private FavoriteService $service;

    public function __construct(FavoriteService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/favorites",
     *     summary="Получить избранное для текущего пользователя",
     *     tags={"Favorite"},
     *
     *     @OA\Response(
     *          response=200,
     *          description="Избранное пользователя",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Favorite"
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
        $favorite = FavoriteService::getFavorites();

        return response()->json(new FavoriteDTO(
            all: $favorite['all'],
            essences: $favorite['essences'],
        ));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/favorites/products/{productId}",
     *     summary="Добавить отдельное изображение в избранное",
     *     tags={"Favorite"},
     *
     *     @OA\Parameter(
     *          name="productId",
     *          description="Id добавляемого изображения",
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
     *          response=201,
     *          description="Успешно добавлено",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Произошла ошибка при добавлении",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function storeProduct(Product $product)
    {
        try {
            $this->service->addToFavorite(Product::class, $product->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка добавления товара в избранное: ' . $exception->getMessage());

            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже',
            ], 400);
        }

        return $this->responseJson(['message' => 'Успешно добавлено!'], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/favorites/sub-essences/{subEssenceId}",
     *     summary="Добавить sub-essence в избранное",
     *     tags={"Favorite"},
     *
     *     @OA\Parameter(
     *          name="subEssenceId",
     *          description="Id добавляемого sub-essence",
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
     *          response=201,
     *          description="Успешно добавлено",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Произошла ошибка при добавлении",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function storeSubEssence(SubEssence $subEssence)
    {
        try {
            $this->service->addToFavorite(SubEssence::class, $subEssence->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка добавления категории в избранное: ' . $exception->getMessage());

            return $this->responseJson(['message' => 'failed'], 400);
        }

        return $this->responseJson(['message' => 'Успешно добавлено!'], 201);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/favorites/products/{productId}",
     *     summary="Удалить отдельное изображение из избранного",
     *     tags={"Favorite"},
     *
     *     @OA\Parameter(
     *          name="productId",
     *          description="Id удаляемого изображения",
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
     *          response=204,
     *          description="Успешно удалено",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Произошла ошибка при удалении",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function destroyProduct(Product $product)
    {
        try {
            $this->service->deleteFromFavorite(Product::class, $product->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка удаления товара из избранного: ' . $exception->getMessage());

            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже',
            ], 400);
        }

        return $this->responseJson(['message' => 'Успешно удалено!'], 204);
    }

    /**
     * @OA\Delete (
     *     path="/api/v1/favorites/sub-essences/{subEssenceId}",
     *     summary="Удалить sub-essence из избранного",
     *     tags={"Favorite"},
     *
     *     @OA\Parameter(
     *          name="subEssenceId",
     *          description="Id удаляемого sub-essence",
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
     *          response=204,
     *          description="Успешно удалено",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     @OA\Response(
     *          response=400,
     *          description="Произошла ошибка при добавлении",
     *              @OA\JsonContent(
     *                  @OA\Property(
     *                      property="message",
     *                      type="string"
     *                  )
     *              )
     *     ),
     *     security={
     *       {"auth_api": {}}
     *     }
     * )
     *
     * @return JsonResponse
     */
    public function destroySubEssence(SubEssence $subEssence)
    {
        try {
            $this->service->deleteFromFavorite(SubEssence::class, $subEssence->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка удаления категории из избранного: ' . $exception->getMessage());

            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже',
            ], 400);
        }

        return $this->responseJson(['message' => 'Успешно удалено!'], 204);
    }
}

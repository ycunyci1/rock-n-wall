<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubEssence;
use App\Services\FavoriteService;
use Illuminate\Support\Facades\Log;

class FavoriteController extends BaseApiController
{
    private FavoriteService $service;

    public function __construct(FavoriteService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(FavoriteService::getFavorites());
    }

    public function storeProduct(Product $product)
    {
        try {
            $this->service->addToFavorite(Product::class, $product->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка добавления товара в избранное: ' . $exception->getMessage());
            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже'
            ], 400);
        }

        return $this->responseJson(['message' => 'Успешно добавлено']);
    }

    public function storeSubEssence(SubEssence $subEssence)
    {
        try {
            $this->service->addToFavorite(SubEssence::class, $subEssence->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка добавления категории в избранное: ' . $exception->getMessage());
            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже'
            ], 400);
        }
        return $this->responseJson(['message' => 'Успешно добавлено']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyProduct(Product $product)
    {
        try {
            $this->service->deleteFromFavorite(Product::class, $product->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка удаления товара из избранного: ' . $exception->getMessage());
            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже'
            ], 400);
        }

        return $this->responseJson(['message' => 'Успешно удалено']);
    }

    public function destroySubEssence(SubEssence $subEssence)
    {
        try {
            $this->service->deleteFromFavorite(SubEssence::class, $subEssence->id);
        } catch (\Exception $exception) {
            Log::error('Ошибка удаления категории из избранного: ' . $exception->getMessage());
            return $this->responseJson([
                'message' => 'Произошла ошибка, попробуйте повторить попытку позже'
            ], 400);
        }

        return $this->responseJson(['message' => 'Успешно удалено']);
    }
}

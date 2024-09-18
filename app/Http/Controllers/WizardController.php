<?php

namespace App\Http\Controllers;

use App\DTO\Resources\WizardDTO;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class WizardController extends BaseApiController
{
    /**
     * @OA\Get(
     *     path="/api/v1/wizard",
     *     summary="Получить данные визарда",
     *     tags={"Pages"},
     *
     *     @OA\Response(
     *          response=200,
     *          description="Данные для визарда",
     *
     *          @OA\JsonContent(
     *              ref="#/components/schemas/WizardData"
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
        $products = Product::inRandomOrder()->take(10)->get();
        return $this->responseJson(
            new WizardDTO($products)
        );
    }
}

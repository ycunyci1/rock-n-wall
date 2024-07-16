<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="ProductInfoDialog",
 *     description="Данные для модального окна продукта"
 * )
 */
class ProductInfoDTO extends Data
{
    /**
     * @var string
     * @OA\Property(format="integer", example="123")
     */
    public string $subEssenceId;

    /**
     * @var string
     * @OA\Property(format="string", example="Cats")
     */
    public string $essenceName;

    /**
     * @var string
     * @OA\Property(format="string", example="Cats")
     */
    public string $subEssenceName;

    /**
     * @var string
     * @OA\Property(format="string", example="http://domain/storage/images/black-car.jpg")
     */
    public string $image;

    /**
     * @var integer
     * @OA\Property(format="integer", example="Animals")
     */
    public int $productsCount;
}

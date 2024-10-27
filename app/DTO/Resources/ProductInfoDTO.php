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
    public function __construct(
        /**
         * @OA\Property(format="integer", example="123")
         */
        public string $subEssenceId,

        /**
         * @OA\Property(format="string", example="selections/categories")
         */
        public string $displayType,

        /**
         * @OA\Property(format="string", example="Cats")
         */
        public string $essenceName,

        /**
         * @OA\Property(format="string", example="Cats")
         */
        public string $subEssenceName,

        /**
         * @OA\Property(format="string", example="http://domain/storage/images/black-car.jpg")
         */
        public ?string $image = null,

        /**
         * @OA\Property(format="integer", example="Animals")
         */
        public int    $productsCount
    )
    {
        $this->image = $this->image ? config('app.url') . $this->image : null;
    }
}

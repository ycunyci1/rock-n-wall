<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="Favorite",
 *     description="Данные для главной страницы"
 * )
 */
class FavoriteDTO extends Data
{
    public function __construct(
        /**
         * @var array
         *
         * @OA\Property (
         *     format="array",
         *
         *     @OA\Items(ref="#/components/schemas/Product")
         * )
         */
        #[DataCollectionOf(ProductDTO::class)]
        public iterable $all,

        /**
         * @var array
         *
         * @OA\Property (
         *     format="array",
         *
         *     @OA\Items(ref="#/components/schemas/FavoriteEssence")
         * )
         */
        #[DataCollectionOf(FavoriteEssenceDTO::class)]
        public iterable $essences
    ) {
    }
}

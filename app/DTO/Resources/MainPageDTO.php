<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @OA\Schema(
 *     schema="MainPageData",
 *     description="Данные для главной страницы"
 * )
 */
class MainPageDTO extends Data
{
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
    public iterable $liveImages;

    /**
     * @var array
     *
     * @OA\Property (
     *     format="array",
     *
     *     @OA\Items(ref="#/components/schemas/MainPageEssence")
     * )
     */
    #[DataCollectionOf(EssenceDTO::class)]
    public iterable $essences;

    /**
     * @param  DataCollection  $liveImages
     * @param  DataCollection  $essences
     */
    public function __construct(
        iterable $liveImages,
        iterable $essences
    ) {
        $this->liveImages = $liveImages;
        $this->essences = $essences;
    }
}

<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="ProductShow",
 *     description="Данные для детальной страницы изображения"
 * )
 */
class ProductShowDTO extends Data
{
    /**
     * @OA\Property (
     *     ref="#/components/schemas/Product"
     * )
     */
    public ProductDTO $product;

    /**
     * @var array
     *
     * @OA\Property (
     *     format="array",
     *
     *     @OA\Items(ref="#/components/schemas/ProductInfoDialog")
     * )
     */
    #[DataCollectionOf(ProductInfoDTO::class)]
    public iterable $info;

    /**
     * @OA\Property (
     *     ref="#/components/schemas/AiPrompt"
     * )
     */
    public ?AiPromptDTO $promptDetail;
}

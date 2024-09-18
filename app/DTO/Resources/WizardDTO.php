<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @OA\Schema(
 *     schema="WizardData",
 *     description="Данные для визарда"
 * )
 */
class WizardDTO extends Data
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
    public iterable $items;

    /**
     * @OA\Property(format="integer", example="123")
     */
    public string $isSelectedId;

    /**
     * @param  DataCollection  $items
     */
    public function __construct(
        iterable $items
    ) {
        $this->items = ProductDTO::collect($items);
        $this->isSelectedId = $items->random()?->id;
    }
}

<?php

namespace App\DTO\Resources;

use App\Enum\EssenceDisplayTypeEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="SubEssenceShow",
 *     description="Sub essence show data"
 * )
 */
class SubEssenceShowDTO extends Data
{
    public function __construct(
        /**
         * @var int
         *
         * @OA\Property(format="string", example="123")
         */
        public int $id,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="Cats")
         */
        public string $name,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="http://domain/storage/images/cats.jpg")
         */
        public string $image,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="selections/categories")
         */
        public string $displayType,

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
        public iterable $products

    ) {
        $this->products = ProductDTO::collect($this->products->where('live', 0)->take(30));
        $this->displayType = $this->displayType == '0' ? EssenceDisplayTypeEnum::DISPLAY_TYPE_HORIZONTAL->value : EssenceDisplayTypeEnum::DISPLAY_TYPE_VERTICAL->value;
        $this->image = $this->image ? config('app.url') . $this->image : null;
    }
}

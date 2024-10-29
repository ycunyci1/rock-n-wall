<?php

namespace App\DTO\Resources;

use App\Enum\EssenceDisplayTypeEnum;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="SubEssence",
 *     description="Sub essence data"
 * )
 */
class SubEssenceDTO extends Data
{
    public function __construct(
        /**
         * @OA\Property(format="string", example="123")
         */
        public int    $id,

        /**
         * @OA\Property(format="string", example="Cats")
         */
        public string $name,

        /**
         * @OA\Property(format="integer", example="15")
         */
        public int    $productsCount,

        /**
         * @OA\Property(format="string", example="horizontal/vertical")
         */
        public ?string $displayType,

        /**
         * @OA\Property(format="string", example="http://domain/storage/images/cats.jpg")
         */
        public ?string $image = null,
    )
    {
        $this->image = $this->image ? config('app.url') . $this->image : null;
    }
}

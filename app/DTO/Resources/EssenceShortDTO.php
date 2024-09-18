<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="ShortEssence",
 *     description="Essence data"
 * )
 */
class EssenceShortDTO extends Data
{
    public function __construct(
        /**
         * @var int
         *
         * @OA\Property(format="string", example="123")
         */
        public int    $id,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="Animals")
         */
        public string $name,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="horizontal/vertical")
         */
        public string $displayType,
    )
    {
    }
}

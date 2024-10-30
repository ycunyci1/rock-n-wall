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
    /**
     * @var string
     *
     * @OA\Property(format="string", example="horizontal/vertical")
     */
    public string $displayType;
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
    )
    {
        $this->displayType = $this->name == 'Categories' ? 'horizontal' : 'vertical';
    }
}

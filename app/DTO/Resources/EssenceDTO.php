<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @OA\Schema(
 *     schema="MainPageEssence",
 *     description="Essence data"
 * )
 */
class EssenceDTO extends Data
{
    public function __construct(
        /**
         * @var integer
         * @OA\Property(format="string", example="123")
         */
        public int      $id,

        /**
         * @var string
         * @OA\Property(format="string", example="Animals")
         */
        public string   $name,

        /**
         * @var array
         * @OA\Property (
         *     format="array",
         *     @OA\Items(ref="#/components/schemas/SubEssence")
         * )
         */
        #[DataCollectionOf(SubEssenceDTO::class)]
        public iterable $subEssences)
    {
        $this->subEssences = SubEssenceDTO::collect($this->subEssences);
    }
}

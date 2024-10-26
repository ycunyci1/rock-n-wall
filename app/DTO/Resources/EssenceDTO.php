<?php

namespace App\DTO\Resources;

use App\Enum\EssenceDisplayTypeEnum;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

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
         * @var int
         *
         * @OA\Property(format="string", example="123")
         */
        public int $id,

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

        /**
         * @var array
         *
         * @OA\Property (
         *     format="array",
         *
         *     @OA\Items(ref="#/components/schemas/SubEssence")
         * )
         */
        #[DataCollectionOf(SubEssenceDTO::class)]
        public iterable $subEssences)
    {
        $this->subEssences = SubEssenceDTO::collect($this->subEssences->sortBy('sort')->values());
        $this->displayType = $this->displayType == '0' ? EssenceDisplayTypeEnum::DISPLAY_TYPE_HORIZONTAL->value : EssenceDisplayTypeEnum::DISPLAY_TYPE_VERTICAL->value;;
    }
}

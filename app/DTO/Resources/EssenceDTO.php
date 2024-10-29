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
        public int      $id,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="Animals")
         */
        public string   $name,

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
        public iterable $subEssences,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="horizontal/vertical")
         */
        public ?string  $displayType = null)
    {
        $this->subEssences = SubEssenceDTO::collect($this->subEssences->sortBy('sort')->values());
        $this->displayType = $this->name == 'Categories' ? EssenceDisplayTypeEnum::DISPLAY_TYPE_HORIZONTAL->value : EssenceDisplayTypeEnum::DISPLAY_TYPE_VERTICAL->value;;
    }
}

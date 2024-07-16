<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="Product",
 *     description="Product data"
 * )
 */
class ProductDTO extends Data
{
    /**
     * @var integer
     * @OA\Property(format="string", example="123")
     */
    public int $id;

    /**
     * @var string
     * @OA\Property(format="string", example="Black car")
     */
    public string $name;

    /**
     * @var bool
     * @OA\Property(format="bool", example="true")
     */
    public bool $vip;

    /**
     * @var bool
     * @OA\Property(format="bool", example="true")
     */
    public bool $live;

    /**
     * @var string
     * @OA\Property(format="string", example="http://domain/storage/images/black-car.jpg")
     */
    public string $image;
}

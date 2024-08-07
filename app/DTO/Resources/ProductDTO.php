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
     * @OA\Property(format="string", example="123")
     */
    public int $id;

    /**
     * @OA\Property(format="string", example="Black car")
     */
    public string $name;

    /**
     * @OA\Property(format="bool", example="true")
     */
    public bool $vip;

    /**
     * @OA\Property(format="bool", example="true")
     */
    public bool $live;

    /**
     * @OA\Property(format="string", example="http://domain/storage/images/black-car.jpg")
     */
    public string $image;
}

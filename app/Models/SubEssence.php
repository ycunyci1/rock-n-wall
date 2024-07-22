<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * Class SubEssence
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $main_product_id
 * @property string|null $essence_id
 * @property int|null $sort
 * @property string $created_at
 * @property string $updated_at
 * @property int $productsCount
 * @property string $url
 * @property string|null $image
 * @property string|null $displayType
 * @property Essence|null $essence
 * @property Collection|Product[] $products
 * @property Product|null $mainProduct
 * @property Collection|Favorite[] $favorites
 */
class SubEssence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function essence(): BelongsTo
    {
        return $this->belongsTo(Essence::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function mainProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'main_product_id', 'id');
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products->count();
    }

    public function getImageAttribute()
    {
        return $this->mainProduct->image;
    }

    public function getUrlAttribute(): string
    {
        return route('sub-essence.show', ['essence' => $this->essence_id, 'subEssence' => $this->id]);
    }

    public function getSubEssenceIdAttribute(): int
    {
        return $this->id;
    }

    public function getEssenceNameAttribute(): string
    {
        return $this->essence->name;
    }

    public function getSubEssenceNameAttribute(): string
    {
        return $this->name;
    }

    public function getDisplayTypeAttribute():string
    {
        return $this->essence?->display_type;
    }
}

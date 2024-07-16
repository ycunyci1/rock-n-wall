<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * Class Essence
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $sort
 * @property string|null $display_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Collection|SubEssence[] $subEssences
 * @property string $url
 *
 * @package App\Models
 */
class Essence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subEssences(): HasMany
    {
        return $this->hasMany(SubEssence::class);
    }

    public function getUrlAttribute(): string
    {
        return route('essence.show', $this->id);
    }
}

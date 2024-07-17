<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Orchid\Attachment\Attachable;

class Product extends Model
{
    use Attachable;
    use HasFactory;

    protected $guarded = [];

    public function subEssences(): BelongsToMany
    {
        return $this->belongsToMany(SubEssence::class);
    }

    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function autochangers(): BelongsToMany
    {
        return $this->belongsToMany(AutoChanger::class);
    }
}

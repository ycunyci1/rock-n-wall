<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function favoritable(): MorphTo
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Platform\Models\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role', 'admin_id', 'role_id');
    }
}

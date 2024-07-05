<?php

namespace App\Models\SystemManager\Setting;

use App\Models\SystemManager\Master\Menu;
use App\Models\SystemManager\Master\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleMenu extends Model
{
    use HasFactory;

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    
    public function roleMenuDetail(): HasMany
    {
        return $this->hasMany(RoleMenuDetail::class);
    }
}

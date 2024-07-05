<?php

namespace App\Models\SystemManager\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleMenuDetail extends Model
{
    use HasFactory;

    public function roleMenu(): BelongsTo
    {
        return $this->belongsTo(RoleMenu::class);
    }
}

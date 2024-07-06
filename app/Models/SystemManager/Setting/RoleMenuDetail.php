<?php

namespace App\Models\SystemManager\Setting;

use App\Models\SystemManager\Master\Menu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoleMenuDetail extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // public function roleMenu(): BelongsTo
    // {
    //     return $this->belongsTo(RoleMenu::class);
    // }
}

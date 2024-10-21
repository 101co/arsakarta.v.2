<?php

namespace App\Models\SystemManager\Master;

use App\Models\SystemManager\Setting\RoleMenu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model {
    use HasFactory;
    protected $table = 'sysmanm_menu';

    public function application(): BelongsTo {
        return $this->belongsTo(Application::class);
    }
}

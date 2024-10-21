<?php

namespace App\Models\AssetManagement\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model {
    use HasFactory;
    protected $table = 'assetmanm_asset';

    public function casts() {
        return [
            'asset_detail' => 'array',
        ];
    }
}

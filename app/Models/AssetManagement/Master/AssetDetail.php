<?php

namespace App\Models\AssetManagement\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDetail extends Model {
    use HasFactory;
    protected $table = 'assetmanm_asset_detail';

    public function assetType() {
        return $this->belongsTo(AssetType::class);
    }
}

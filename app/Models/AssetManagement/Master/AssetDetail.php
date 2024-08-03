<?php

namespace App\Models\AssetManagement\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetDetail extends Model
{
    use HasFactory;

    public function assetType()
    {
        return $this->belongsTo(AssetType::class);
    }
}

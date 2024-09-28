<?php

namespace App\Models\AssetManagement\Transaction;

use App\Models\AssetManagement\Master\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetVehicleServiceTransaction extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
        'service_details' => 'array'
    ];

    public function asset() 
    {
        return $this->belongsTo(Asset::class);    
    }
}

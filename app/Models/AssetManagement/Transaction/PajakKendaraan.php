<?php

namespace App\Models\AssetManagement\Transaction;

use App\Models\AssetManagement\Master\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakKendaraan extends Model {
    use HasFactory;
    protected $table = 'assetmant_pajak_kendaraan';

    public function asset() {
        return $this->belongsTo(Asset::class);    
    }
}

<?php

namespace App\Models\HotWheels\Transaction;

use App\Models\HotWheels\Master\HotWheelsCarBrand;
use App\Models\HotWheels\Master\HotWheelsLot;
use App\Models\HotWheels\Master\HotWheelsSeri;
use App\Models\HotWheels\Master\HotWheelsType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotWheelsMyCollection extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array',
    ];

    public function hotWheelsCarBrand()
    {
        return $this->belongsTo(HotWheelsCarBrand::class);
    }

    public function hotWheelsType()
    {
        return $this->belongsTo(HotWheelsType::class);
    }

    public function hotWheelsLot()
    {
        return $this->belongsTo(HotWheelsLot::class);
    }

    public function hotWheelsSeri()
    {
        return $this->belongsTo(HotWheelsSeri::class);
    }
}

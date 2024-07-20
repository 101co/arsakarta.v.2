<?php

namespace App\Models\DigitalInvitation\Setting;

use App\Models\DigitalInvitation\Master\Feature;
use App\Models\DigitalInvitation\Master\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    use HasFactory;

    public function casts()
    {
        return [
            'features' => 'array',
        ];
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function feature()
    {
        return $this->hasMany(Feature::class);
    }
}

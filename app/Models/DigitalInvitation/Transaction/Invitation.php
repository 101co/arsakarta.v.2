<?php

namespace App\Models\DigitalInvitation\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\DigitalInvitation\Master\Package;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Models\DigitalInvitation\Master\EventCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    protected $table = 'arskrtt_invitation';

    function eventCategory() {
        return $this->belongsTo(EventCategory::class);
    }

    function package() {
        return $this->belongsTo(Package::class);
    }

    // scope agar user tidak bisa sembarangan buka data orang
    protected static function booted(): void {
        static::addGlobalScope('ancient', function (Builder $builder) {
            $builder->where('user_id', '=', auth()->user()->id);
        });
    }
}

<?php

namespace App\Models\DigitalInvitation\Transaction;

use App\Models\DigitalInvitation\Master\Package;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationBAK extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(Package::class, 'selected_package_id', 'id')->withDefault();
    }

}

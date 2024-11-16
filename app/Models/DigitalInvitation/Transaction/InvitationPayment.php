<?php

namespace App\Models\DigitalInvitation\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationPayment extends Model {
    use HasFactory;
    protected $table = 'arskrtt_invitation_payment';

    function invitation() {
        return $this->belongsTo(Invitation::class);
    }
}

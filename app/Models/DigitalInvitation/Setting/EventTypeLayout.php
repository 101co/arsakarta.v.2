<?php

namespace App\Models\DigitalInvitation\Setting;

use App\Models\DigitalInvitation\Master\EventType;
use App\Models\DigitalInvitation\Master\Layout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTypeLayout extends Model
{
    use HasFactory;

    public function casts()
    {
        return [
            'layouts' => 'array',
        ];
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function layout()
    {
        return $this->hasMany(Layout::class);
    }
}

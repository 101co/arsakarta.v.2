<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventCategory extends Model {
    use HasFactory;

    protected $table = 'arskrtm_event_category';

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastEventCategory = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastEventCategory ? (int)Str::after($lastEventCategory->initial, 'EC') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: EC001, EC002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal EC001, EC002
        return 'EC' . $newNumber;
    }
}

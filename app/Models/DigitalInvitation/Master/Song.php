<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Song extends Model
{
    use HasFactory;

    protected $table = 'arskrtm_song';

    public function eventCategory() {
        return $this->belongsTo(EventCategory::class);
    }

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastSong = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastSong ? (int)Str::after($lastSong->initial, 'S') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: T0001, T0002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal TM001, TM002
        return 'S' . $newNumber;
    }
}

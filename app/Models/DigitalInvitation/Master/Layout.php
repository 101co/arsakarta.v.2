<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Layout extends Model {
    use HasFactory;

    protected $table = 'arskrtm_layout';

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastLayout = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastLayout ? (int)Str::after($lastLayout->initial, 'L') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: L001, L002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal P001, P002
        return 'L' . $newNumber;
    }
}

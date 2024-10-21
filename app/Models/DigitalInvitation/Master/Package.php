<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model {
    use HasFactory;

    protected $table = 'arskrtm_package';

    protected function casts(): array {
        return [
            'detail' => 'array',
        ];
    } 

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastPackage = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastPackage ? (int)Str::after($lastPackage->initial, 'P') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: P001, P002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal P001, P002
        return 'P' . $newNumber;
    }
}

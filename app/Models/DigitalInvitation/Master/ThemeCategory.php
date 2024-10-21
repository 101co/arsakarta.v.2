<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThemeCategory extends Model {
    use HasFactory;

    protected $table = 'arskrtm_theme_category';

    public function themeMaster() {
        return $this->hasMany(ThemeMaster::class);
    }

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastThemeCategory = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastThemeCategory ? (int)Str::after($lastThemeCategory->initial, 'TC') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: TC001, TC002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal TC001, TC002
        return 'TC' . $newNumber;
    }
}

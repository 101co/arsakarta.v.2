<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemeMaster extends Model {
    use HasFactory;

    protected $table = 'arskrtm_theme_master';

    public function themeCategory() : BelongsTo {
        return $this->belongsTo(ThemeCategory::class);
    }

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastThemeMaster = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastThemeMaster ? (int)Str::after($lastThemeMaster->initial, 'TM') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: TM001, TM002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal TM001, TM002
        return 'TM' . $newNumber;
    }
}

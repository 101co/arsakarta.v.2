<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LayoutThemePage extends Model {
    use HasFactory;

    protected $table = 'arskrtm_layout_theme_page';

    public function themeMaster() {
        return $this->belongsTo(ThemeMaster::class);
    }
    
    public function layout() {
        return $this->belongsTo(Layout::class);
    }

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastLayoutThemePage = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastLayoutThemePage ? (int)Str::after($lastLayoutThemePage->initial, 'LTP') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: LTP001, LTP002)
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal P001, P002
        return 'LTP' . $newNumber;
    }
}

<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected function casts(): array {
        return [
            'layouts' => 'array',
        ];
    } 

    protected $table = 'arskrtm_theme';

    public function themeMaster() : BelongsTo {
        return $this->belongsTo(ThemeMaster::class);
    }

    public function package() : BelongsTo {
        return $this->belongsTo(Package::class);
    }

    public function eventCategory() : BelongsTo {
        return $this->belongsTo(eventCategory::class);
    }

    // Function untuk generate kode
    public static function generateCode() {
        // Mengambil record terakhir dari tabel
        $lastTheme = self::orderBy('id', 'desc')->first();

        // Ambil running number dari record terakhir, jika ada, tambahkan 1
        $lastNumber = $lastTheme ? (int)Str::after($lastTheme->initial, 'T') : 0;

        // Format kode baru, tambahkan leading zeroes (misal: T0001, T0002)
        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

        // Mengembalikan kode baru, misal TM001, TM002
        return 'T' . $newNumber;
    }
}

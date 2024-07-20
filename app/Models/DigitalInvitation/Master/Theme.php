<?php

namespace App\Models\DigitalInvitation\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    } 

    public function themeCategory()
    {
        return $this->belongsTo(ThemeCategories::class);
    }
}

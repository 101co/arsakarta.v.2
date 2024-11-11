<?php

namespace App\Models\MiniUrl\Transaction;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MiniUrl extends Model
{
    use HasFactory;

    protected $table = 'miniurlt_mini_url';

    public function user() {
        return $this->belongsTo(User::class);
    }
}

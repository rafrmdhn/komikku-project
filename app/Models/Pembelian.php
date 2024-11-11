<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function komik()
    {
        return $this->belongsTo(Komik::class, 'komik_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

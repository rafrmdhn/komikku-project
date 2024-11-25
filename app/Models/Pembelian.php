<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detail_pembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

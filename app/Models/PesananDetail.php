<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'qty',
        'harga'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // 🔥 TAMBAHAN WAJIB
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
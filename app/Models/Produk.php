<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Produk extends Model
{
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    protected $fillable = [
    'kategori_id',
    'nama_produk',
    'deskripsi',
    'harga',
    'stok',
    'is_active',
    'gambar_1',
    'gambar_2',
    'gambar_3',
];
}

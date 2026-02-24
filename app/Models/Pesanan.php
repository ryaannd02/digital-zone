<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'alamat_id',
        'layanan_pengiriman',
        'ongkir',
        'total_harga',
        'total_bayar',
        'payment_status',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function details()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
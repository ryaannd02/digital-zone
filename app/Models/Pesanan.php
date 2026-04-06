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
        'expired_at',
        'payment_method',
        'payment_detail',
    ];

        public static function generateKode()
    {
        do {
            $random = mt_rand(1000, 99999999); // 4 - 8 digit
            $kode = 'DGZ-' . $random;
        } while (self::where('kode', $kode)->exists());

        return $kode;
    }

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pesanan) {
            if (!$pesanan->kode) {
                $pesanan->kode = self::generateKode();
            }
        });
    }

}
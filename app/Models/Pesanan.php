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
        'tracking_status',
        'tracking_started_at',
        'ongkir_type',
    ];

    protected $casts = [
    'tracking_started_at' => 'datetime',
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

    public function getTrackingStatusRealtime()
    {
        if ($this->order_status !== 'dikirim' || !$this->tracking_started_at) {
            return null;
        }

        $diff = $this->tracking_started_at->diffInSeconds(now());

        // REGULER
        if ($this->ongkir_type === 'reguler') {
            if ($diff >= 120) return 'sampai';
            elseif ($diff >= 90) return 'menuju_alamat';
            elseif ($diff >= 60) return 'perjalanan';
            else return 'pickup';
        }

        // EXPRESS
        if ($this->ongkir_type === 'express') {
            if ($diff >= 40) return 'sampai';
            elseif ($diff >= 30) return 'menuju_alamat';
            elseif ($diff >= 20) return 'perjalanan';
            else return 'pickup';
        }

        // EKONOMIS
        if ($this->ongkir_type === 'ekonomis') {
            if ($diff >= 180) return 'sampai';
            elseif ($diff >= 140) return 'menuju_alamat';
            elseif ($diff >= 100) return 'perjalanan';
            else return 'pickup';
        }

        return 'pickup';
    }

}
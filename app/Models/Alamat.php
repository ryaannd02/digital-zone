<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    protected $fillable = [
        'user_id',
        'nama_penerima',
        'no_telepon',
        'alamat_lengkap',
        'label',
        'is_primary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
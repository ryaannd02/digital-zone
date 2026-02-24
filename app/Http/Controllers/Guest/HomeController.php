<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil SEMUA produk (bukan dibatasi)
        $produks = Produk::latest()->get();

        return view('guest.home', compact('produks'));
    }
}

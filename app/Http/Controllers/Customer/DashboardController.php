<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua produk (atau bisa pakai take(6) kalau mau dibatasi)
        $produks = Produk::latest()->get();

        return view('customer.dashboard', compact('produks'));
    }
}
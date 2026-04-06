<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔥 COUNT
        $diproses = Pesanan::where('payment_status', 'paid')
            ->where('order_status', 'diproses')
            ->count();

        $dikirim = Pesanan::where('payment_status', 'paid')
            ->where('order_status', 'dikirim')
            ->count();

        // 🔥 LOG (10 TERBARU)
        $logs = Pesanan::where('payment_status', 'paid')
            ->whereIn('order_status', ['diproses', 'dikirim', 'selesai'])
            ->latest()
            ->take(10)
            ->get();

        return view('petugas.dashboard', compact(
            'diproses',
            'dikirim',
            'logs'
        ));
    }
}
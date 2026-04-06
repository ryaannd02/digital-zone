<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();

        $totalPesanan = Pesanan::count();

        $totalPendapatan = Pesanan::where('payment_status', 'paid')
            ->sum('total_bayar');

        $pesananTerbaru = Pesanan::latest()->take(5)->get();

        // 🔥 DATA CHART BULANAN
        $chart = Pesanan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(total_bayar) as total')
            )
            ->where('payment_status', 'paid')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'totalPendapatan',
            'pesananTerbaru',
            'chart'
        ));
    }
}
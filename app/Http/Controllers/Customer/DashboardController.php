<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    public function index()
    {
        $produks = Produk::where('is_active', 1)
            ->where('stok', '>', 0)   
            ->inRandomOrder()
            ->take(20)
            ->get();

        $terlaris = PesananDetail::select(
                'produk_id',
                DB::raw('SUM(qty) as total_terjual')
            )
            ->whereHas('pesanan', function($q){
                $q->where('payment_status', 'paid'); // hanya yang berhasil
            })
            ->groupBy('produk_id')
            ->orderByDesc('total_terjual')
            ->take(5)
            ->with('produk')
            ->get();

        return view('customer.dashboard', compact('produks', 'terlaris'));
}
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
public function index(Request $request)
{
    $from = $request->from;
    $to = $request->to;

    // 🔥 BASE QUERY
    $baseQuery = Pesanan::with('details')
        ->where('payment_status', 'paid');

    // 🔥 FILTER TANGGAL
    if ($from && $to) {
        $baseQuery->whereBetween('created_at', [
            $from . ' 00:00:00',
            $to . ' 23:59:59'
        ]);
    }

    // =========================
    // 🔥 1. DATA UNTUK STATISTIK (SEMUA)
    // =========================
    $allPesanans = (clone $baseQuery)->get();

    // =========================
    // 🔥 2. DATA UNTUK TABEL (10 TERBARU)
    // =========================
    $pesanans = (clone $baseQuery)
        ->latest()
        ->limit(10)
        ->get();

    // =========================
    // 🔥 TOP PRODUK
    // =========================
    $topProduk = DB::table('pesanan_details')
        ->join('produks', 'pesanan_details.produk_id', '=', 'produks.id')
        ->join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
        ->where('pesanans.payment_status', 'paid')
        ->select('produks.nama_produk', DB::raw('SUM(qty) as total'))
        ->groupBy('produks.nama_produk')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

    // =========================
    // 🔥 GRAFIK
    // =========================
    $chart = DB::table('pesanans')
        ->selectRaw('DATE(created_at) as tanggal, SUM(total_bayar) as total')
        ->where('payment_status', 'paid')
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();

    // =========================
    // 🔥 STATISTIK
    // =========================
    $totalPendapatan = $allPesanans->sum('total_bayar');

    $totalPesanan = $allPesanans->count();

    $totalProduk = $allPesanans->sum(function ($p) {
        return $p->details->sum('qty');
    });

    return view('admin.laporan.index', compact(
        'pesanans',
        'from',
        'to',
        'totalPendapatan',
        'totalPesanan',
        'totalProduk',
        'topProduk',
        'chart'
    ));
}

    public function pdf(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = Pesanan::with('details', 'user')
            ->where('payment_status', 'paid');

        if ($from && $to) {
            $query->whereBetween('created_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59'
            ]);
        }

        $pesanans = $query->get();

        $totalPendapatan = $pesanans->sum('total_bayar');
        $totalPesanan = $pesanans->count();

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'pesanans',
            'totalPendapatan',
            'totalPesanan',
            'from',
            'to'
        ));

        return $pdf->download('laporan.pdf');
    }
}
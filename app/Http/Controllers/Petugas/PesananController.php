<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PesananController extends Controller
{
public function index(Request $request)
{
    $status = $request->status;
    $search = $request->search;

    $query = \App\Models\Pesanan::with('user')
        ->whereIn('order_status', ['diproses', 'dikirim']); // tetap sama seperti sebelumnya

    // 🔥 FILTER STATUS (AMAN)
    if ($status && $status !== 'semua') {
        $query->where('order_status', $status);
    }

    // 🔥 SEARCH KODE (AMAN)
    if ($search) {
        $query->where('kode', 'like', "%$search%");
    }

    $pesanans = $query->latest()->paginate(10)->withQueryString();

    return view('petugas.pesanan.index', compact(
        'pesanans',
        'status',
        'search'
    ));
}

    public function riwayat(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        $query = \App\Models\Pesanan::with('user')
            ->where('order_status', 'selesai'); // tetap sama ✔

        // 🔥 FILTER TANGGAL
        if ($dari && $sampai) {
            $query->whereBetween('created_at', [$dari, $sampai]);
        } elseif ($dari) {
            $query->whereDate('created_at', '>=', $dari);
        } elseif ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        $pesanans = $query->latest()->paginate(10)->withQueryString();

        return view('petugas.riwayat.index', compact(
            'pesanans',
            'dari',
            'sampai'
        ));
    }

    

    public function show($id)
    {
        $pesanan = \App\Models\Pesanan::with(['user', 'details.produk', 'alamat'])
            ->findOrFail($id);

        return view('petugas.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = \App\Models\Pesanan::findOrFail($id);

        $allowed = [
            'diproses' => 'dikirim',
            'dikirim' => 'selesai',
        ];

        $current = $pesanan->order_status;
        $next = $request->order_status;

        // validasi
        if (!isset($allowed[$current]) || $allowed[$current] !== $next) {
            return back()->with('error', 'Tidak bisa mengubah status ke tahap ini');
        }

        $pesanan->update([
            'order_status' => $next
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }
}

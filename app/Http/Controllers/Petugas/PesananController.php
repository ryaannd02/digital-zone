<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

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
        ];

        $current = $pesanan->order_status;
        $next = $request->order_status;

        // validasi
        if (!isset($allowed[$current]) || $allowed[$current] !== $next) {
            return back()->with('error', 'Tidak bisa mengubah status ke tahap ini');
        }

        $dataUpdate = [
            'order_status' => $next
        ];

        // 🔥 JIKA STATUS JADI DIKIRIM → START TRACKING
        if ($next === 'dikirim') {
            $dataUpdate['tracking_status'] = 'pickup';
            $dataUpdate['tracking_started_at'] = now();

            // sesuaikan dengan field ongkir kamu
            $dataUpdate['ongkir_type'] = $pesanan->layanan_pengiriman ?? 'reguler';
        }

        $pesanan->update($dataUpdate);

        // 🔔 NOTIFIKASI KE USER (SAMA SEPERTI ADMIN)
        if ($next === 'dikirim') {
            Notification::create([
                'user_id' => $pesanan->user_id,
                'type' => 'status',
                'title' => 'Pesanan Dikirim',
                'message' => 'Pesanan dengan kode ' . $pesanan->kode . ' saat ini sedang dalam proses pengiriman oleh kurir. Mohon menunggu hingga paket sampai ke alamat tujuan. Pastikan nomor yang Anda cantumkan aktif agar kurir dapat menghubungi jika diperlukan.',
            ]);
        }

        return back()->with('success', 'Status berhasil diperbarui');
    }
}

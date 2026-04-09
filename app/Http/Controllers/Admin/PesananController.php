<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Notification;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('user');

        // filter status
        if ($request->status) {
            $query->where('order_status', $request->status);
        }

        $pesanans = $query->latest()->paginate(10);

        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('details.produk', 'user', 'alamat')
            ->findOrFail($id);

        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // ❌ belum bayar
        if ($pesanan->payment_status !== 'paid') {
            return back()->with('error', 'Pesanan belum dibayar');
        }

        // 🔥 HANYA BOLEH DIPROSES → DIKIRIM
        if ($pesanan->order_status !== 'diproses' || $request->order_status !== 'dikirim') {
            return back()->with('error', 'Status hanya bisa diubah dari diproses ke dikirim');
        }

        $dataUpdate = [
            'order_status' => 'dikirim'
        ];

        // 🔥 START TRACKING (WAJIB ADA)
        $dataUpdate['tracking_status'] = 'pickup';
        $dataUpdate['tracking_started_at'] = now();
        $dataUpdate['ongkir_type'] = $pesanan->layanan_pengiriman ?? 'reguler';

        $pesanan->update($dataUpdate);

        // 🔥 NOTIFIKASI HANYA DIKIRIM
        Notification::create([
            'user_id' => $pesanan->user_id,
            'type' => 'status',
            'title' => 'Pesanan Dikirim',
            'message' => 'Pesanan dengan kode ' . $pesanan->kode . ' saat ini sedang dalam proses pengiriman oleh kurir. Mohon menunggu hingga paket sampai ke alamat tujuan. Pastikan nomor yang Anda cantumkan aktif agar kurir dapat menghubungi jika diperlukan.',
        ]);

        return back()->with('success', 'Pesanan berhasil dikirim');
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::with('details.produk', 'user', 'alamat')
            ->findOrFail($id);

        $pdf = Pdf::loadView('admin.pesanan.invoice', compact('pesanan'));

        return $pdf->download('invoice-'.$pesanan->kode.'.pdf');
    }
}
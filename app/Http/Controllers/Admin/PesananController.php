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

        // urutan status
        $statusOrder = [
            'tertunda' => 1,
            'diproses' => 2,
            'dikirim' => 3,
            'selesai' => 4,
        ];

        $current = $statusOrder[$pesanan->order_status];
        $new = $statusOrder[$request->order_status];

        // ❌ tidak boleh mundur
        if ($new < $current) {
            return back()->with('error', 'Tidak bisa mengubah status mundur');
        }

        $pesanan->update([
            'order_status' => $request->order_status
        ]);

        Notification::create([
        'user_id' => $pesanan->user_id,
        'type' => 'status',
        'title' => match($request->order_status) {
            'diproses' => 'Pesanan Diproses 📦',
            'dikirim' => 'Pesanan Dikirim 🚚',
            'selesai' => 'Pesanan Selesai ✅',
            default => 'Update Pesanan'
        },
        'message' => match($request->order_status) {
            'dikirim' => 'Pesanan dengan kode ' . $pesanan->kode . ' saat ini sedang dalam proses pengiriman oleh kurir. Mohon menunggu hingga paket sampai ke alamat tujuan. Pastikan nomor yang Anda cantumkan aktif agar kurir dapat menghubungi jika diperlukan.',
            'selesai' => 'Pesanan dengan kode ' . $pesanan->kode . ' telah berhasil diselesaikan dan diterima. Terima kasih telah berbelanja bersama kami. Semoga produk yang Anda terima sesuai dengan harapan dan memberikan kepuasan.',
            default => 'Status pesanan Anda dengan kode ' . $pesanan->kode . ' telah diperbarui. Silakan cek detail pesanan untuk informasi lebih lanjut mengenai perubahan yang terjadi.'
        },
        ]);

        return back()->with('success', 'Status berhasil diupdate');
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::with('details.produk', 'user', 'alamat')
            ->findOrFail($id);

        $pdf = Pdf::loadView('admin.pesanan.invoice', compact('pesanan'));

        return $pdf->download('invoice-'.$pesanan->kode.'.pdf');
    }
}
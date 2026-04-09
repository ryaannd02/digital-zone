<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        // =========================
        // 🔥 1. UPDATE EXPIRED JADI GAGAL
        // =========================
        $expiredOrders = Pesanan::with('details.produk')
            ->where('payment_status', 'pending')
            ->whereNotNull('expired_at')
            ->where('expired_at', '<=', now())
            ->get();

        foreach ($expiredOrders as $order) {

            if ($order->payment_status !== 'pending') {
                continue;
            }

            // 🔥 BALIKIN STOK
            foreach ($order->details as $detail) {
                if ($detail->produk) {
                    $detail->produk->increment('stok', $detail->qty);
                }
            }

            Pesanan::where('id', $order->id)->update([
                'payment_status' => 'failed',
                'order_status' => 'gagal'
            ]);

            Notification::create([
                'user_id' => $order->user_id,
                'type' => 'payment',
                'title' => 'Pembayaran Gagal',
                'message' => 'Pesanan dengan kode' . $order->kode . ' telah dibatalkan secara otomatis karena tidak dilakukan pembayaran dalam batas waktu 10 menit. Silakan lakukan pemesanan ulang apabila masih ingin melanjutkan pembelian produk tersebut.',
            ]);
        }
        // =========================
        // 🔥 2. AMBIL DATA PESANAN
        // =========================
        $pesanans = Pesanan::with([
                'user',
                'alamat',
                'details.produk'
            ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // =========================
        // 🔥 3. AUTO TRACKING (TAMBAH DI SINI)
        // =========================
        foreach ($pesanans as $order) {

            if ($order->order_status === 'selesai') {
                $order->tracking_status = 'sampai';
                continue;
            }

            if ($order->order_status === 'dikirim' && $order->tracking_started_at) {

                $diff = $order->tracking_started_at->diffInSeconds(now());

                // 🔥 REGULER
                if ($order->ongkir_type === 'reguler') {

                    if ($diff >= 120) {
                        $order->tracking_status = 'sampai';
                    } elseif ($diff >= 90) {
                        $order->tracking_status = 'menuju_alamat';
                    } elseif ($diff >= 60) {
                        $order->tracking_status = 'perjalanan';
                    } else {
                        $order->tracking_status = 'pickup';
                    }

                }

                // 🔥 EXPRESS
                elseif ($order->ongkir_type === 'express') {

                // EXPRESS (lebih cepat)
                if ($diff >= 40) {
                    $order->tracking_status = 'sampai';
                } elseif ($diff >= 30) {
                    $order->tracking_status = 'menuju_alamat';
                } elseif ($diff >= 20) {
                    $order->tracking_status = 'perjalanan';
                } else {
                    $order->tracking_status = 'pickup';
                }

                }

                // 🔥 EKONOMIS
                elseif ($order->ongkir_type === 'ekonomis') {

                    if ($diff >= 180) {
                        $order->tracking_status = 'sampai';
                    } elseif ($diff >= 140) {
                        $order->tracking_status = 'menuju_alamat';
                    } elseif ($diff >= 100) {
                        $order->tracking_status = 'perjalanan';
                    } else {
                        $order->tracking_status = 'pickup';
                    }

                }
            }
        }

        // =========================
        // 🔥 3. RETURN VIEW
        // =========================
        return view('customer.pesanan.index', compact('pesanans'));
    }

    public function expire($id)
    {
        $order = Pesanan::findOrFail($id);

        if ($order->payment_status == 'pending') {
            $order->update([
                'payment_status' => 'failed',
                'order_status' => 'gagal'
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function selesai($id)
    {
        $order = Pesanan::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        if ($order->order_status !== 'dikirim') {
            return back()->with('error', 'Status tidak valid');
        }

        $order->update([
            'order_status' => 'selesai',
            'tracking_status' => 'sampai'
        ]);

        Notification::create([
            'user_id' => $order->user_id,
            'type' => 'order',
            'title' => 'Pesanan Selesai',
            'message' => 'Pesanan #' . $order->kode . ' sudah selesai! Terima kasih banyak atas kepercayaan Anda berbelanja di tempat kami. Kami harap Anda puas dengan produk yang diterima. Sampai jumpa di pesanan berikutnya.',
        ]);

        return back()->with('success', 'Pesanan selesai');
    }

    public function invoice($id)
    {
        $pesanan = Pesanan::with('details.produk', 'user', 'alamat')
            ->where('user_id', auth()->id()) // 🔒 biar aman (user cuma lihat miliknya)
            ->findOrFail($id);

        $pdf = Pdf::loadView('admin.pesanan.invoice', compact('pesanan'));

        return $pdf->download('invoice-'.$pesanan->kode.'.pdf');
    }
}
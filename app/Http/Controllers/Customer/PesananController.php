<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Ambil semua data dari Midtrans
        $data = $request->all();

        \Log::info('MIDTRANS CALLBACK DATA:', $data);

        $orderId = $data['order_id'] ?? null;
        $transactionStatus = $data['transaction_status'] ?? null;
        $fraudStatus = $data['fraud_status'] ?? null;

        \Log::info('TRANSACTION STATUS: ' . $transactionStatus);
        \Log::info('FRAUD STATUS: ' . $fraudStatus);

        if (!$orderId) {
            return response()->json(['message' => 'No Order ID'], 400);
        }

        // Format ORDER-21-1771780007
        $explode = explode('-', $orderId);
        $realId = $explode[1] ?? null;

        \Log::info('REAL ID: ' . $realId);

        if (!$realId) {
            return response()->json(['message' => 'Invalid Order ID'], 400);
        }

        $pesanan = Pesanan::find($realId);

        \Log::info('PESANAN FOUND: ' . ($pesanan ? 'YES' : 'NO'));

        if (!$pesanan) {
            return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
        }

        // ==============================
        // STATUS SUCCESS (SIMPLIFIED)
        // ==============================
        if (
            $transactionStatus === 'settlement' ||
            $transactionStatus === 'capture'
        ) {

            $pesanan->update([
                'payment_status' => 'paid',
                'order_status'   => 'diproses',
            ]);

            \Log::info('STATUS DIUBAH KE PAID');
        }

        // ==============================
        // STATUS PENDING
        // ==============================
        elseif ($transactionStatus === 'pending') {

            $pesanan->update([
                'payment_status' => 'pending',
            ]);

            \Log::info('STATUS TETAP PENDING');
        }

        // ==============================
        // STATUS FAILED
        // ==============================
        elseif (
            $transactionStatus === 'expire' ||
            $transactionStatus === 'cancel' ||
            $transactionStatus === 'deny'
        ) {

            $pesanan->update([
                'payment_status' => 'failed',
                'order_status'   => 'tertunda',
            ]);

            \Log::info('STATUS DIUBAH KE FAILED');
        }

        return response()->json(['message' => 'Callback processed'], 200);
    }
}
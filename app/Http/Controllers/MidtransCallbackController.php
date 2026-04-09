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
        \Log::info('ORDER ID: ' . $orderId);

        // 🔥 pecah order_id
        $parts = explode('-', $orderId);

        // ambil DGZ-xxxx
        $kode = $parts[0] . '-' . $parts[1];

        \Log::info('KODE ASLI: ' . $kode);

        // cari pesanan
        $pesanan = Pesanan::where('kode', $kode)->first();

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

            // ❗ cegah double update
            if ($pesanan->payment_status !== 'paid') {

            $paymentType = $data['payment_type'] ?? null;
            $paymentDetail = '-';

            switch ($paymentType) {

                case 'bank_transfer':
                    $paymentDetail = $data['va_numbers'][0]['bank'] ?? 'Bank Transfer';
                    break;

                case 'echannel':
                    $paymentDetail = 'Mandiri';
                    break;

                case 'credit_card':
                    $paymentDetail = strtoupper($data['bank'] ?? 'CARD') . ' ' . strtoupper($data['card_type'] ?? '');
                    break;

                case 'qris':
                    $paymentDetail = 'QRIS';
                    break;

                case 'gopay':
                    $paymentDetail = 'GoPay';
                    break;

                case 'shopeepay':
                    $paymentDetail = 'ShopeePay';
                    break;

                default:
                    $paymentDetail = ucfirst($paymentType ?? '-');
                    break;
            }

            \Log::info('PAYMENT TYPE: ' . $paymentType);
            \Log::info('PAYMENT DETAIL: ' . $paymentDetail);

                $pesanan->update([
                    'payment_status' => 'paid',
                    'order_status'   => 'diproses',
                    'payment_method' => $paymentType,
                    'payment_detail' => $paymentDetail,
                ]); 

                \App\Models\Notification::create([
                    'user_id' => $pesanan->user_id,
                    'type' => 'order',
                    'title' => 'Pesanan Diproses',
                    'message' => 'Pesanan #' . $pesanan->kode . ' sedang diproses oleh penjual. Kami tengah mempersiapkan pesanan Anda untuk memastikan kualitas terbaik sebelum dikirim. Informasi lebih lanjut akan segera kami sampaikan.',
                ]);

                \Log::info('STATUS DIUBAH KE PAID');

            } else {
                \Log::info('SKIP, SUDAH PAID');
            }
        }

        

        // ==============================
        // STATUS PENDING
        // ==============================
        elseif ($transactionStatus === 'pending') {

            // ❗ JANGAN override kalau sudah paid
            if ($pesanan->payment_status !== 'paid') {

                $pesanan->update([
                    'payment_status' => 'pending',
                ]);

                \Log::info('STATUS SET PENDING');
            } else {
                \Log::info('SKIP PENDING, SUDAH PAID');
            }
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
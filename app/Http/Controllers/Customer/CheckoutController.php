<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Alamat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;

class CheckoutController extends Controller
{
    // =========================
    // HALAMAN REVIEW CHECKOUT
    // =========================
    public function index(Request $request)
    {
        $selectedItems = $request->selected_items;

        if (!$selectedItems) {
            return redirect()->route('keranjang.index')
                ->with('error', 'Pilih produk terlebih dahulu');
        }

        $items = Keranjang::with('produk')
            ->whereIn('id', $selectedItems)
            ->where('user_id', Auth::id())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('keranjang.index');
        }

        $subtotal = $items->sum(fn($i) => $i->qty * $i->produk->harga);

        $alamats = Alamat::where('user_id', Auth::id())
            ->orderByDesc('is_primary')
            ->get();

        if ($alamats->isEmpty()) {
            return redirect()->route('alamat.index')
                ->with('error', 'Tambahkan alamat terlebih dahulu');
        }

        return view('customer.checkout.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'alamats' => $alamats,
            'selectedItems' => $selectedItems,
        ]);
    }

    // =========================
    // PROSES PEMBAYARAN
    // =========================
    public function process(Request $request)
    {
        $request->validate([
            'alamat_id' => 'required',
            'layanan' => 'required',
            'selected_items' => 'required|array'
        ]);

        $services = [
            'reguler' => 14000,
            'besok' => 22000,
            'ekonomis' => 8000,
        ];

        $ongkir = $services[$request->layanan] ?? 0;

        $items = Keranjang::with('produk')
            ->whereIn('id', $request->selected_items)
            ->where('user_id', Auth::id())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('keranjang.index');
        }

        $subtotal = $items->sum(fn($i) => $i->qty * $i->produk->harga);
        $totalBayar = $subtotal + $ongkir;

        // =========================
        // BUAT PESANAN
        // =========================
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'alamat_id' => $request->alamat_id,
            'layanan_pengiriman' => $request->layanan,
            'ongkir' => $ongkir,
            'total_harga' => $subtotal,
            'total_bayar' => $totalBayar,
            'payment_status' => 'pending',
            'order_status' => 'tertunda',
        ]);

        foreach ($items as $item) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $item->produk_id,
                'qty' => $item->qty,
                'harga' => $item->produk->harga,
            ]);
        }

        // Hapus item keranjang setelah create pesanan
        Keranjang::whereIn('id', $request->selected_items)
            ->where('user_id', Auth::id())
            ->delete();

        // =========================
        // MIDTRANS CONFIG
        // =========================
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = false;
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $pesanan->id . '-' . time(),
                'gross_amount' => $totalBayar,
            ],
            'customer_details' => [
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('customer.checkout.snap', compact('snapToken'));
    }
}
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
use App\Models\Produk;
use App\Models\Notification;

class CheckoutController extends Controller
{
    // =========================
    // HALAMAN REVIEW CHECKOUT
    // =========================
    public function index(Request $request)
    {
        // =========================
        // MODE 1: BELI LANGSUNG
        // =========================
        if ($request->produk_id) {

            $produk = Produk::findOrFail($request->produk_id);

            $items = collect([
                (object)[
                    'produk' => $produk,
                    'qty' => $request->qty ?? 1
                ]
            ]);

            $selectedItems = null; // penting

        } 
        // =========================
        // MODE 2: DARI KERANJANG
        // =========================
        else {

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
        }

        // =========================
        // HITUNG TOTAL
        // =========================
        $subtotal = $items->sum(fn($i) => $i->qty * $i->produk->harga);

        // =========================
        // ALAMAT
        // =========================
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
        // =========================
        // VALIDASI
        // =========================
        $request->validate([
            'alamat_id' => 'required',
            'layanan' => 'required',
        ]);

        $services = [
            'reguler' => 14000,
            'besok' => 22000,
            'ekonomis' => 8000,
        ];

        $ongkir = $services[$request->layanan] ?? 0;

        // =========================
        // CEK MODE (KERANJANG / BELI LANGSUNG)
        // =========================

        // 🔥 MODE 1: DARI KERANJANG
        if ($request->has('selected_items')) {

            $items = Keranjang::with('produk')
                ->whereIn('id', $request->selected_items)
                ->where('user_id', Auth::id())
                ->get();

        } 
        // 🔥 MODE 2: BELI SEKARANG
        else {

            $request->validate([
                'produk_id' => 'required',
                'qty' => 'required|integer|min:1'
            ]);

            $produk = Produk::findOrFail($request->produk_id);

            // bikin format biar sama kayak keranjang
            $items = collect([
                (object)[
                    'produk_id' => $produk->id,
                    'qty' => $request->qty,
                    'produk' => $produk
                ]
            ]);
        }

        // =========================
        // VALIDASI ITEM
        // =========================
        if ($items->isEmpty()) {
            return redirect()->route('keranjang.index');
        }

        // =========================
        // 🔥 VALIDASI + RESERVE STOK
        // =========================
        foreach ($items as $item) {

            // ❌ cek stok cukup
            if ($item->produk->stok < $item->qty) {
                return back()->with('error', 'Stok produk ' . $item->produk->nama_produk . ' tidak mencukupi');
            }

            // 🔥 kurangi stok
            $item->produk->decrement('stok', $item->qty);
        }

        $subtotal = $items->sum(fn($i) => $i->qty * $i->produk->harga);
        $totalBayar = $subtotal + $ongkir;

        // =========================
        // BUAT PESANAN
        // =========================
        $pesanan = Pesanan::create([
            'kode' => Pesanan::generateKode(),
            'user_id' => Auth::id(),
            'alamat_id' => $request->alamat_id,
            'layanan_pengiriman' => $request->layanan,
            'ongkir' => $ongkir,
            'total_harga' => $subtotal,
            'total_bayar' => $totalBayar,
            'payment_status' => 'pending',
            'order_status' => 'tertunda',
            'expired_at' => now()->addMinutes(10), // 🔥 INI KUNCI
        ]);


        Notification::create([
        'user_id' => Auth::id(),
        'type' => 'checkout',
        'title' => 'Pesanan Berhasil Dibuat',
        'message' => 'Pesanan dengan kode #' . $pesanan->kode . ' berhasil dibuat dengan total pembayaran sebesar Rp ' . number_format($totalBayar) . '. Silakan segera melakukan pembayaran sesuai metode yang tersedia agar pesanan dapat segera diproses oleh sistem kami.',
        ]);

        foreach ($items as $item) {
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $item->produk_id,
                'qty' => $item->qty,
                'harga' => $item->produk->harga,
            ]);
        }

        // =========================
        // HAPUS KERANJANG (KALAU DARI CART)
        // =========================
        if ($request->has('selected_items')) {
            Keranjang::whereIn('id', $request->selected_items)
                ->where('user_id', Auth::id())
                ->delete();
        }
        

        // =========================
        // MIDTRANS
        // =========================
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = false;
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->kode . '-' . time(),
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

    public function retry($id)
    {
        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->payment_status != 'pending') {
            return back();
        }

        // 🔥 RESET TIMER
        $pesanan->update([
            'expired_at' => now()->addMinutes(10)
        ]);

        // 🔥 MIDTRANS CONFIG
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = false;
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $pesanan->kode . '-' . time(),
                'gross_amount' => $pesanan->total_bayar,
            ],
            'customer_details' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('customer.checkout.snap', compact('snapToken'));
    }
}
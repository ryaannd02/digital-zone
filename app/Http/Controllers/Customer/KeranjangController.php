<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        return view('customer.keranjang.index', compact('keranjang'));
    }

    public function store(Request $request, $produk_id)
    {
        $produk = Produk::find($produk_id);

        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan');
        }

        // 🔥 AMBIL QTY DARI FORM
        $qty = max(1, (int) $request->qty);

        $item = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $produk_id)
            ->first();

        if ($item) {
            // 🔥 TAMBAH SESUAI QTY (BUKAN +1)
            $item->qty += $qty;
            $item->save();
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $produk_id,
                'qty' => $qty, // 🔥 FIX DI SINI
            ]);
        }

        return redirect()->route('keranjang.index')
            ->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $item = Keranjang::with('produk')->findOrFail($id);

        // 🔒 Produk tidak ada
        if (!$item->produk) {
            $item->delete();
            return response()->json([
                'error' => 'Produk sudah tidak tersedia'
            ], 400);
        }

        $qty = max(1, (int) $request->qty);

        // 🔒 Stok tidak cukup
        if ($qty > $item->produk->stok) {
            return response()->json([
                'error' => 'Stok tidak mencukupi'
            ], 400);
        }

        $item->update(['qty' => $qty]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        $item = Keranjang::findOrFail($id);
        $item->delete();

        return back();
    }
}
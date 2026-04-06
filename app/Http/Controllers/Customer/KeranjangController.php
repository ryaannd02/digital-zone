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

    public function store($produk_id)
    {
        // 🔒 Validasi produk ada
        $produk = Produk::find($produk_id);

        if (!$produk) {
            return back()->with('error', 'Produk tidak ditemukan');
        }

        $item = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $produk_id)
            ->first();

        if ($item) {
            $item->increment('qty');
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $produk_id,
                'qty' => 1,
            ]);
        }

        return redirect()->route('keranjang.index')
            ->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $item = Keranjang::with('produk')->findOrFail($id);

        // 🔒 Validasi produk masih ada
        if (!$item->produk) {
            $item->delete();
            return back()->with('error', 'Produk sudah tidak tersedia');
        }

        // 🔒 Validasi qty minimal
        $qty = max(1, (int) $request->qty);

        // 🔒 Validasi stok (optional tapi bagus)
        if ($qty > $item->produk->stok) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $item->update(['qty' => $qty]);

        return back();
    }

    public function destroy($id)
    {
        $item = Keranjang::findOrFail($id);
        $item->delete();

        return back();
    }
}
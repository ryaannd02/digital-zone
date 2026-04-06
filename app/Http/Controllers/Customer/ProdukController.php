<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->get();
        return view('customer.produk.index', compact('produk'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('customer.produk.show', compact('produk'));
    }
    public function kategori($kategori)
    {
        $produk = Produk::whereHas('kategori', function ($q) use ($kategori) {
            $q->where('nama_kategori', $kategori);
        })
        ->where('is_active', 1)
        ->where('stok', '>', 0)
        ->latest()
        ->get();

        return view('customer.produk.kategori', compact('produk', 'kategori'));
}
}

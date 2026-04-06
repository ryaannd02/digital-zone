<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class ProdukController extends Controller
{

public function index(Request $request)
{
    $kategori = $request->kategori;

    $query = Produk::with('kategori');

    // 🔥 FILTER BERDASARKAN NAMA KATEGORI
    if ($kategori) {
        $query->whereHas('kategori', function ($q) use ($kategori) {
            $q->where('nama_kategori', $kategori);
        });
    }

    $produks = $query->latest()->paginate(10)->withQueryString();

    // ambil kategori untuk tombol
    $kategoris = Kategori::all();

    return view('petugas.produk.index', compact('produks', 'kategori', 'kategoris'));
}
}
<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;
        $sort = $request->sort;
        $kategori = $request->kategori;

        $query = Produk::query()
            ->where('is_active', 1)
            ->where('stok', '>', 0)

            // 🔍 SEARCH (optional kalau q ada)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('nama_produk', 'like', "%$q%")
                        ->orWhere('deskripsi', 'like', "%$q%");
                });
            })

            // 📂 FILTER KATEGORI
            ->when($kategori, function ($query) use ($kategori) {
                $query->where('kategori_id', $kategori);
            });

        // 🔥 SORT
        if ($sort === 'termurah') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort === 'termahal') {
            $query->orderBy('harga', 'desc');
        } else {
            $query->latest();
        }

        $produks = $query->paginate(12)->withQueryString();

        // 🔥 ambil kategori untuk filter UI
        $kategoris = Kategori::all();

        return view('customer.search.index', compact(
            'produks',
            'q',
            'sort',
            'kategori',
            'kategoris'
        ));
    }

    // 🔥 AUTO SUGGEST
    public function suggest(Request $request)
    {
        $q = $request->q;

        $produks = Produk::where('is_active', 1)
            ->where('stok', '>', 0)
            ->where('nama_produk', 'like', "%$q%")
            ->limit(5)
            ->get(['id', 'nama_produk']);

        return response()->json($produks);
    }
}
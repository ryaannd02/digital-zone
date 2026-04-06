<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori');

        if ($request->search) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $produks = $query->latest()->paginate(10);
        $produks->appends($request->all());

        $kategoris = Kategori::all();

        return view('admin.produk.index', compact('produks', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'gambar_1' => 'required|image',
            'gambar_2' => 'nullable|image',
            'gambar_3' => 'nullable|image',
        ]);

        // upload gambar
        foreach (['gambar_1','gambar_2','gambar_3'] as $gambar) {
            if ($request->hasFile($gambar)) {
                $data[$gambar] = $request->file($gambar)->store('produk','public');
            }
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.produk.edit', compact('produk','kategoris'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $data = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'is_active' => 'required|boolean',
            'gambar_1' => 'nullable|image',
            'gambar_2' => 'nullable|image',
            'gambar_3' => 'nullable|image',
        ]);

        foreach (['gambar_1','gambar_2','gambar_3'] as $gambar) {
            if ($request->hasFile($gambar)) {
                $data[$gambar] = $request->file($gambar)->store('produk','public');
            }
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        Produk::findOrFail($id)->delete();

        return back()->with('success', 'Produk dihapus');
    }

    public function toggle($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->update([
            'is_active' => !$produk->is_active
        ]);

        return back()->with('success', 'Status produk diupdate');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        if (!$ids) {
            return back()->with('error', 'Pilih minimal 1 produk');
        }

        Produk::whereIn('id', $ids)->delete();

        return back()->with('success', 'Produk berhasil dihapus');
        
    }
    }
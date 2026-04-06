@extends('admin.layout')

@section('content')

<h1 class="text-3xl font-semibold mb-8 text-gray-800 flex items-center gap-2">
    <i data-lucide="pencil"></i>
    Edit Produk
</h1>

@if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 p-4 mb-6 rounded-xl">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-8">

    <!-- INFORMASI PRODUK -->
    <div>
        <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i data-lucide="info"></i>
            Informasi Produk
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <!-- KATEGORI -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Kategori</label>
                <div class="relative">
                    <i data-lucide="layers" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                    <select name="kategori_id"
                        class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                        required>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id }}"
                                {{ $produk->kategori_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- STATUS -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Status</label>
                <div class="relative">
                    <i data-lucide="toggle-right" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                    <select name="is_active"
                        class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400">
                        <option value="1" {{ $produk->is_active ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !$produk->is_active ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- NAMA -->
            <div class="md:col-span-2">
                <label class="text-sm text-gray-600 mb-1 block">Nama Produk</label>
                <div class="relative">
                    <i data-lucide="package" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                    <input type="text" name="nama_produk"
                        value="{{ $produk->nama_produk }}"
                        class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                        required>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="md:col-span-2">
                <label class="text-sm text-gray-600 mb-1 block">Deskripsi</label>
                <div class="relative">
                    <i data-lucide="file-text" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                    <textarea name="deskripsi"
                        rows="4"
                        class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                        required>{{ $produk->deskripsi }}</textarea>
                </div>
            </div>

            <!-- HARGA -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Harga</label>
                <div class="relative">
                    <i data-lucide="banknote" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                    <input type="number" name="harga"
                        value="{{ $produk->harga }}"
                        class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                        required>
                </div>
            </div>

            <!-- STOK -->
            <div>
                <label class="text-sm text-gray-600 mb-1 block">Stok</label>
                <div class="relative">
                    <i data-lucide="boxes" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
                    <input type="number" name="stok"
                        value="{{ $produk->stok }}"
                        class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                        required>
                </div>
            </div>

        </div>
    </div>

    <!-- GAMBAR -->
    <div>
        <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i data-lucide="image"></i>
            Gambar Produk
        </h2>

        <div class="grid md:grid-cols-3 gap-6">

            <div>
                <label class="text-sm text-gray-600 mb-2 block">Gambar 1</label>
                <img src="{{ asset('storage/'.$produk->gambar_1) }}"
                     class="w-24 h-24 object-cover mb-2 rounded-lg border">
                <input type="file" name="gambar_1"
                    class="w-full text-sm border border-gray-300 rounded-xl px-3 py-2">
            </div>

            <div>
                <label class="text-sm text-gray-600 mb-2 block">Gambar 2</label>
                @if($produk->gambar_2)
                    <img src="{{ asset('storage/'.$produk->gambar_2) }}"
                         class="w-24 h-24 object-cover mb-2 rounded-lg border">
                @endif
                <input type="file" name="gambar_2"
                    class="w-full text-sm border border-gray-300 rounded-xl px-3 py-2">
            </div>

            <div>
                <label class="text-sm text-gray-600 mb-2 block">Gambar 3</label>
                @if($produk->gambar_3)
                    <img src="{{ asset('storage/'.$produk->gambar_3) }}"
                         class="w-24 h-24 object-cover mb-2 rounded-lg border">
                @endif
                <input type="file" name="gambar_3"
                    class="w-full text-sm border border-gray-300 rounded-xl px-3 py-2">
            </div>

        </div>
    </div>

    <!-- BUTTON -->
    <div class="flex justify-end gap-3 pt-4 border-t">

        <a href="{{ route('admin.produk.index') }}"
           class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition flex items-center gap-2">
            <i data-lucide="arrow-left"></i>
            Batal
        </a>

        <button type="submit"
                class="px-6 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-800 transition flex items-center gap-2">
            <i data-lucide="save"></i>
            Update
        </button>

    </div>

</div>
</form>

@endsection
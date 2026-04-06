@extends('petugas.layout')

@section('content')



    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Produk</h1>
        <p class="text-sm text-gray-500">Kelola produk berdasarkan kategori</p>
    </div>

    {{-- 🔥 FILTER KATEGORI --}}
    <div class="flex gap-3 mb-6 flex-wrap">

        <a href="{{ route('petugas.produk.index') }}"
        class="px-4 py-2 rounded-lg text-sm border transition
        {{ !$kategori 
            ? 'bg-blue-600 text-white border-blue-600 shadow-sm' 
            : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-600' }}">
            Semua
        </a>

        @foreach($kategoris as $kat)
            <a href="{{ route('petugas.produk.index', ['kategori'=>$kat->nama_kategori]) }}"
            class="px-4 py-2 rounded-lg text-sm border transition
            {{ $kategori == $kat->nama_kategori 
                ? 'bg-blue-600 text-white border-blue-600 shadow-sm' 
                : 'bg-white text-gray-700 border-gray-200 hover:bg-blue-50 hover:text-blue-600' }}">
            {{ $kat->nama_kategori }}
            </a>
        @endforeach

    </div>

    {{-- 🔥 TABEL --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="p-4 text-left">Gambar</th>
                    <th class="text-left">Nama</th>
                    <th class="text-left">Kategori</th>
                    <th class="text-left">Harga</th>
                    <th class="text-left">Stok</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($produks as $produk)
                <tr class="hover:bg-gray-50 transition">

                    <td class="p-4">
                        <img src="{{ asset('storage/'.$produk->gambar_1) }}"
                             class="w-16 h-16 object-cover rounded-lg border">
                    </td>

                    <td class="font-medium text-gray-800">
                        {{ $produk->nama_produk }}
                    </td>

                    <td class="text-gray-600 capitalize">
                        {{ $produk->kategori->nama_kategori ?? '-' }}
                    </td>

                    <td class="font-medium text-gray-800">
                        Rp {{ number_format($produk->harga) }}
                    </td>

                    <td>{{ $produk->stok }}</td>

                    <td>
                        @if($produk->is_active)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Aktif
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-600">
                                Nonaktif
                            </span>
                        @endif
                    </td>

                    <td>
                        <button onclick='showDetail(@json($produk))'
                                class="inline-flex items-center gap-1 bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-700 transition">

                            <i data-lucide="eye" class="w-3 h-3"></i>
                            Detail
                        </button>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">
                        Tidak ada produk
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>



{{-- 🔥 MODAL --}}
<div id="modal"
     class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-full max-w-lg max-h-[85vh] shadow-xl overflow-hidden"
         onclick="event.stopPropagation()">

        <div class="overflow-y-auto max-h-[85vh] p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="box" class="w-4 h-4"></i>
                Detail Produk
            </h2>

            <!-- 🔥 FIX GAMBAR (NO CROP) -->
            <div class="w-full h-56 bg-gray-50 flex items-center justify-center rounded-lg mb-4 border">
                <img id="modalImage"
                     class="max-h-full max-w-full object-contain">
            </div>

            <div class="space-y-2 text-sm text-gray-700">
                <p><b>Nama:</b> <span id="modalNama"></span></p>
                <p><b>Harga:</b> <span id="modalHarga"></span></p>
                <p><b>Stok:</b> <span id="modalStok"></span></p>
                <p><b>Kategori:</b> <span id="modalKategori"></span></p>
                <p><b>Status:</b> <span id="modalStatus"></span></p>
            </div>

            <div class="mt-4">
                <p class="font-semibold text-gray-800 mb-1">Deskripsi</p>
                <p id="modalDeskripsi"
                   class="text-sm text-gray-600 whitespace-pre-line leading-relaxed">
                </p>
            </div>

        </div>

    </div>
</div>

<div class="mt-6">
    {{ $produks->links() }}
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener("DOMContentLoaded", function(){

    const modal = document.getElementById('modal');

    modal.addEventListener('click', function(){
        closeModal();
    });

});

function showDetail(produk){

    const modal = document.getElementById('modal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('modalImage').src = '/storage/' + produk.gambar_1;
    document.getElementById('modalNama').innerText = produk.nama_produk;
    document.getElementById('modalHarga').innerText = 'Rp ' + Number(produk.harga).toLocaleString();
    document.getElementById('modalStok').innerText = produk.stok;
    document.getElementById('modalKategori').innerText = produk.kategori.nama_kategori ?? '-';
    document.getElementById('modalStatus').innerText = produk.is_active ? 'Aktif' : 'Nonaktif';
    document.getElementById('modalDeskripsi').innerText = produk.deskripsi;
}

function closeModal(){
    const modal = document.getElementById('modal');

    modal.classList.remove('flex');
    modal.classList.add('hidden');
}
</script>

@endsection
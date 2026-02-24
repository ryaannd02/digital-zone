@extends('guest.layout')

@section('content')

<!-- HERO BANNER -->
<div class="grid md:grid-cols-2 gap-6 mb-10">

    <div class="bg-gray-300 h-72 rounded-xl flex items-center justify-center">
        Banner Promo
    </div>

    <div class="bg-gray-200 h-72 rounded-xl flex items-center justify-center">
        Banner Produk
    </div>

</div>


<!-- PROMO CARDS -->
<div class="grid md:grid-cols-3 gap-6 mb-12">

    <div class="bg-[#AA1B25] text-white rounded-xl p-6">
        <h3 class="text-xl font-bold">Upgrade Tanpa Batas</h3>
    </div>

    <div class="bg-[#AA1B25] text-white rounded-xl p-6">
        <h3 class="text-xl font-bold">Waktunya Belanja Hemat</h3>
    </div>

    <div class="bg-[#AA1B25] text-white rounded-xl p-6">
        <h3 class="text-xl font-bold">Elektronik Pilihan Terbaik</h3>
    </div>

</div>


<!-- REKOMENDASI PRODUK -->
<h2 class="text-xl font-bold text-[#F5AD1B] mb-6">
    Rekomendasi Produk
</h2>

<div class="grid grid-cols-2 md:grid-cols-3 gap-6">

    @forelse ($produks as $produk)

        <a href="{{ route('produk.show', $produk->id) }}"
           class="block bg-white rounded-xl shadow p-4 hover:shadow-lg transition">

            <div class="h-40 bg-gray-200 rounded mb-3 flex items-center justify-center">
                Gambar
            </div>

            <p class="text-sm">
                {{ $produk->nama_produk }}
            </p>

            <p class="font-bold mt-1">
                Rp {{ number_format($produk->harga) }}
            </p>

        </a>

    @empty
        <p>Belum ada produk</p>
    @endforelse

</div>


<!-- BRAND SECTION -->
<div class="bg-[#F5AD1B] rounded-2xl p-8 mt-14">

    <h3 class="font-bold text-white mb-6 text-lg">
        Brand Pilihan
    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-6">

        @for ($i = 0; $i < 8; $i++)
            <div class="bg-white w-20 h-20 mx-auto rounded-full flex items-center justify-center shadow">
                Brand
            </div>
        @endfor

    </div>

</div>

@endsection
@extends('guest.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10">

    <div class="grid md:grid-cols-2 gap-10">

        {{-- LEFT SIDE - GAMBAR --}}
        <div>

            {{-- Gambar Utama --}}
            <div class="bg-gray-100 rounded-xl p-6 shadow mb-6">
                <img id="mainImage"
                     src="{{ asset('storage/' . $produk->gambar_1) }}"
                     class="w-full object-contain">
            </div>

            {{-- Thumbnail --}}
            <div class="flex gap-4">
                <img src="{{ asset('storage/' . $produk->gambar_1) }}"
                     class="w-28 h-28 object-cover rounded-lg cursor-pointer border hover:border-[#AA1B25]"
                     onclick="changeImage(this)">

                <img src="{{ asset('storage/' . $produk->gambar_2) }}"
                     class="w-28 h-28 object-cover rounded-lg cursor-pointer border hover:border-[#AA1B25]"
                     onclick="changeImage(this)">

                <img src="{{ asset('storage/' . $produk->gambar_3) }}"
                     class="w-28 h-28 object-cover rounded-lg cursor-pointer border hover:border-[#AA1B25]"
                     onclick="changeImage(this)">
            </div>

        </div>


        {{-- RIGHT SIDE - DETAIL --}}
        <div>

            {{-- Tombol Kembali --}}
            <div class="flex justify-end mb-4">
                <a href="{{ route('home') }}"
                   class="bg-[#AA1B25] text-white px-4 py-2 rounded-lg shadow hover:opacity-90">
                    ← Kembali
                </a>
            </div>

            {{-- Nama Produk --}}
            <h1 class="text-3xl font-bold leading-snug">
                {{ $produk->nama_produk }}
            </h1>

            {{-- Harga --}}
            <p class="text-3xl font-bold text-[#AA1B25] mt-3">
                Rp {{ number_format($produk->harga) }}
            </p>

            {{-- Deskripsi --}}
            <div class="mt-6 text-gray-700 leading-relaxed">
                {!! nl2br(e($produk->deskripsi)) !!}
            </div>


            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mt-6">
                    {{ session('success') }}
                </div>
            @endif


            {{-- TOMBOL --}}
            <div class="mt-8">

                @guest
                    <a href="{{ route('login') }}"
                       class="block text-center bg-[#AA1B25] text-white py-4 rounded-xl text-lg font-semibold hover:opacity-90">
                        Login Untuk Beli
                    </a>
                @else

                    <div class="grid grid-cols-2 gap-4">

                        {{-- Tambah Keranjang --}}
                        <form action="{{ route('keranjang.store', $produk->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full bg-black text-white py-4 rounded-xl text-lg font-semibold hover:opacity-90">
                                🛒 Tambah Keranjang
                            </button>
                        </form>

                        {{-- Beli Sekarang --}}
                        <form action="{{ route('keranjang.store', $produk->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="beli_sekarang" value="1">
                            <button type="submit"
                                    class="w-full bg-[#AA1B25] text-white py-4 rounded-xl text-lg font-semibold hover:opacity-90">
                                ⚡ Beli Sekarang
                            </button>
                        </form>

                    </div>

                @endguest

            </div>

        </div>

    </div>

</div>


{{-- Script Ganti Gambar --}}
<script>
    function changeImage(element) {
        document.getElementById('mainImage').src = element.src;
    }
</script>

@endsection
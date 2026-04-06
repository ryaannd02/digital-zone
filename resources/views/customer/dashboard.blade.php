@extends('customer.layout')

@section('content')

<!-- HERO BANNER -->
<div class="grid md:grid-cols-2 gap-6 mb-10">

    <!-- BANNER 1 -->
    <div class="bg-white rounded-2xl shadow p-4 flex items-center justify-center">
        <img src="{{ asset('images/banner1.jpg') }}"
             class="w-full h-auto object-contain">
    </div>

    <!-- BANNER 2 -->
    <div class="bg-white rounded-2xl shadow p-4 flex items-center justify-center">
        <img src="{{ asset('images/banner2.webp') }}"
             class="w-full h-auto object-contain">
    </div>

</div>


<!-- BRAND -->
<div class="bg-white rounded-2xl border p-6">

    <h3 class="font-semibold text-gray-800 mb-6 flex items-center gap-2">
        <!-- building store icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M3 9l9-6 9 6v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
        </svg>
        Brand Pilihan
    </h3>

    @php
        $brands = [
            'apple.jpg',
            'asus.jpg',
            'honor.jpg',
            'huwawei.jpg',
            'infinix.webp',
            'iqoo.jpg',
            'oppo.jpg',
            'realme.jpg',
            'samsung.jpg',
            'vivo.jpg',
        ];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-10 gap-4">

        @foreach ($brands as $brand)
            <div class="h-16 flex items-center justify-center border rounded-xl bg-gray-50 
                        hover:shadow-md hover:-translate-y-1 transition p-2"
                 title="{{ pathinfo($brand, PATHINFO_FILENAME) }}">

                <img src="{{ asset('images/' . $brand) }}"
                     class="max-h-full max-w-full object-contain grayscale hover:grayscale-0 transition duration-300">

            </div>
        @endforeach

    </div>

</div>

<br>
<br>


<!-- SLIDER 4 ITEM (NO SCROLLBAR) -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">

    <div class="h-40 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
        <img src="{{ asset('images/slider1.webp') }}" class="w-full h-full object-cover">
    </div>

    <div class="h-40 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
        <img src="{{ asset('images/slider2.webp') }}" class="w-full h-full object-cover">
    </div>

    <div class="h-40 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
        <img src="{{ asset('images/slider3.webp') }}" class="w-full h-full object-cover">
    </div>

    <div class="h-40 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
        <img src="{{ asset('images/slider4.webp') }}" class="w-full h-full object-cover">
    </div>

</div>

<!-- PRODUK TERLARIS -->
<h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center gap-2">
    <!-- fire icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
        <path d="M13 3s-2 2-2 5 2 4 2 4-1 0-2 1-1 2-1 3a5 5 0 0010 0c0-3-3-5-3-7s-2-6-4-6z"/>
    </svg>
    Produk Terlaris
</h2>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mb-12">

    @forelse ($terlaris as $item)

        @if($item->produk && $item->produk->is_active && $item->produk->stok > 0)

        <a href="{{ route('produk.show', $item->produk->id) }}"
           class="bg-white rounded-xl border hover:shadow-lg hover:-translate-y-1 transition overflow-hidden">

            <div class="h-40 bg-white-100 flex items-center justify-center">
                <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                    class="max-h-full max-w-full object-contain">
            </div>

            <div class="p-3">

                <p class="text-sm line-clamp-2 text-gray-700">
                    {{ $item->produk->nama_produk }}
                </p>

                <p class="font-semibold text-red-600 mt-1">
                    Rp {{ number_format($item->produk->harga) }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    Terjual {{ $item->total_terjual }}
                </p>

            </div>

        </a>

        @endif

    @empty
        <p>Belum ada produk terlaris</p>
    @endforelse

</div>


<!-- REKOMENDASI -->
<h2 class="text-xl font-semibold text-gray-800 mb-5 flex items-center gap-2">
    <!-- sparkles icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
        <path d="M5 3l1.5 3L10 7l-3.5 1L5 11 3.5 8 0 7l3.5-1L5 3zM19 13l1 2 2 1-2 1-1 2-1-2-2-1 2-1 1-2z"/>
    </svg>
    Rekomendasi Produk
</h2>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 mb-14">

    @forelse ($produks as $produk)

        <a href="{{ route('produk.show', $produk->id) }}"
           class="bg-white rounded-xl border hover:shadow-lg hover:-translate-y-1 transition overflow-hidden">

            <div class="h-40 bg-white-100 flex items-center justify-center">
                <img src="{{ asset('storage/' . $produk->gambar_1) }}"
                    class="max-h-full max-w-full object-contain">
            </div>

            <div class="p-3">

                <p class="text-sm line-clamp-2 text-gray-700">
                    {{ $produk->nama_produk }}
                </p>

                <p class="font-semibold text-red-600 mt-1">
                    Rp {{ number_format($produk->harga) }}
                </p>

            </div>

        </a>

    @empty
        <p>Belum ada produk</p>
    @endforelse

</div>


<div class="bg-white rounded-2xl border p-6 mb-12">

    <h3 class="font-semibold text-gray-800 mb-6 flex items-center gap-2">

        <!-- info icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>
        </svg>

        Cara Belanja

    </h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <!-- STEP 1 -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- search icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M8 16l-4.5 4.5M21 21l-4.5-4.5M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-800">Pilih Produk</p>
            <p class="text-xs text-gray-400">Cari produk yang kamu inginkan</p>
        </div>

        <!-- STEP 2 -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- cart icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h13M7 13L5.4 5M10 21a1 1 0 102 0 1 1 0 00-2 0zm8 0a1 1 0 102 0 1 1 0 00-2 0z"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-800">Masukkan Keranjang</p>
            <p class="text-xs text-gray-400">Tambahkan produk ke keranjang</p>
        </div>

        <!-- STEP 3 -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- credit card icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M3 7h18M3 11h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-800">Checkout</p>
            <p class="text-xs text-gray-400">Lakukan pembayaran dengan aman</p>
        </div>

        <!-- STEP 4 -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- package icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M20 13V7a2 2 0 00-1-1.7l-7-4a2 2 0 00-2 0l-7 4A2 2 0 002 7v6a2 2 0 001 1.7l7 4a2 2 0 002 0l7-4a2 2 0 001-1.7z"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-gray-800">Pesanan Dikirim</p>
            <p class="text-xs text-gray-400">Produk sampai ke rumahmu</p>
        </div>

    </div>

</div>


<div class="bg-white rounded-2xl border p-6 mb-12">

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <!-- GRATIS ONGKIR -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- truck icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M9 17H6a2 2 0 01-2-2V7a2 2 0 012-2h7v12zM9 17a3 3 0 106 0M9 17h6M15 17h3a2 2 0 002-2v-3l-3-3h-2"/>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Pengiriman Cepat</p>
            <p class="text-xs text-gray-400">Berbagai pilihan pengiriman</p>
        </div>

        <!-- PRODUK ORIGINAL -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- badge icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M12 3l7 4v5c0 5-3.5 9-7 9s-7-4-7-9V7l7-4z"/>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Produk Original</p>
            <p class="text-xs text-gray-400">100% barang berkualitas</p>
        </div>

        <!-- PEMBAYARAN AMAN -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- shield icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M12 3l8 4v5c0 5-3 9-8 9s-8-4-8-9V7l8-4z"/>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Pembayaran Aman</p>
            <p class="text-xs text-gray-400">Didukung Midtrans</p>
        </div>

        <!-- FAST RESPONSE -->
        <div class="flex flex-col items-center gap-2">
            <div class="bg-red-100 text-red-600 p-3 rounded-full">
                <!-- chat icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" d="M8 10h8M8 14h5M21 12c0 4-4 7-9 7a9 9 0 01-4-.9L3 20l1.2-3.6A7.9 7.9 0 013 12c0-4 4-7 9-7s9 3 9 7z"/>
                </svg>
            </div>
            <p class="font-semibold text-gray-800 text-sm">Fast Response</p>
            <p class="text-xs text-gray-400">Layanan cepat & ramah</p>
        </div>

    </div>

</div>

<div class="bg-white rounded-2xl border p-6 mb-12">

    <h3 class="font-semibold text-gray-800 mb-6 flex items-center gap-2">

        <!-- question icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-width="2" d="M8 10h.01M12 14h.01M16 10h.01M9 16h6M12 2a10 10 0 100 20 10 10 0 000-20z"/>
        </svg>

        Pertanyaan Umum

    </h3>

    <div class="space-y-3" x-data="{ open: null }">

        <!-- ITEM 1 -->
        <div class="border rounded-xl overflow-hidden">
            <button @click="open === 1 ? open = null : open = 1"
                    class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50 transition">

                <span class="text-sm font-medium text-gray-800">
                    Metode pembayaran apa saja yang didukung?
                </span>

                <!-- ICON FIX -->
                <svg :class="open === 1 ? 'rotate-180' : ''"
                     class="w-4 h-4 text-gray-500 transition-transform"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7"/>
                </svg>

            </button>

            <div x-show="open === 1" x-transition class="px-4 pb-4 text-sm text-gray-600">
                Website ini menggunakan layanan pembayaran dari Midtrans yang memungkinkan pengguna melakukan transaksi dengan berbagai metode seperti kartu kredit, transfer bank, e-wallet, dan QRIS. Semua metode pembayaran diproses secara online untuk memastikan transaksi berjalan dengan cepat, aman, dan praktis tanpa perlu proses manual.
            </div>
        </div>


        <!-- ITEM 2 -->
        <div class="border rounded-xl overflow-hidden">
            <button @click="open === 2 ? open = null : open = 2"
                    class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50 transition">

                <span class="text-sm font-medium text-gray-800">
                    Apakah bisa melakukan pembayaran di tempat (COD)?
                </span>

                <!-- ICON FIX -->
                <svg :class="open === 2 ? 'rotate-180' : ''"
                     class="w-4 h-4 text-gray-500 transition-transform"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7"/>
                </svg>

            </button>

            <div x-show="open === 2" x-transition class="px-4 pb-4 text-sm text-gray-600">
                Saat ini sistem belum menyediakan metode pembayaran di tempat atau COD. Semua pesanan harus dibayar secara online melalui sistem pembayaran yang tersedia agar proses verifikasi dapat dilakukan secara otomatis dan pesanan bisa segera diproses tanpa hambatan.
            </div>
        </div>


        <!-- ITEM 3 -->
        <div class="border rounded-xl overflow-hidden">
            <button @click="open === 3 ? open = null : open = 3"
                    class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50 transition">

                <span class="text-sm font-medium text-gray-800">
                    Berapa lama batas waktu untuk melakukan pembayaran?
                </span>

                <!-- ICON FIX -->
                <svg :class="open === 3 ? 'rotate-180' : ''"
                     class="w-4 h-4 text-gray-500 transition-transform"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7"/>
                </svg>

            </button>

            <div x-show="open === 3" x-transition class="px-4 pb-4 text-sm text-gray-600">
                Setelah melakukan checkout, pengguna diberikan waktu selama 10 menit untuk menyelesaikan pembayaran. Jika pembayaran tidak dilakukan dalam batas waktu tersebut, maka pesanan akan otomatis dibatalkan oleh sistem dan tidak dapat dilanjutkan tanpa melakukan pemesanan ulang.
            </div>
        </div>


        <!-- ITEM 4 -->
        <div class="border rounded-xl overflow-hidden">
            <button @click="open === 4 ? open = null : open = 4"
                    class="w-full text-left p-4 flex justify-between items-center hover:bg-gray-50 transition">

                <span class="text-sm font-medium text-gray-800">
                    Apa yang terjadi jika pembayaran tidak berhasil atau kedaluwarsa?
                </span>

                <!-- ICON FIX -->
                <svg :class="open === 4 ? 'rotate-180' : ''"
                     class="w-4 h-4 text-gray-500 transition-transform"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M19 9l-7 7-7-7"/>
                </svg>

            </button>

            <div x-show="open === 4" x-transition class="px-4 pb-4 text-sm text-gray-600">
                Jika pembayaran tidak berhasil atau melewati batas waktu yang ditentukan, maka pesanan akan secara otomatis dibatalkan oleh sistem. Pengguna akan menerima notifikasi terkait pembatalan tersebut, dan stok produk yang sebelumnya dipesan akan dikembalikan sehingga dapat dibeli kembali jika masih tersedia.
            </div>
        </div>

    </div>

</div>

@endsection
@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    <div class="grid md:grid-cols-2 gap-10">

        {{-- LEFT - GAMBAR --}}
        <div>

            <!-- MAIN IMAGE -->
            <div class="bg-gray-50 rounded-2xl p-6 border mb-5 flex items-center justify-center">
                <img id="mainImage"
                     src="{{ asset('storage/' . $produk->gambar_1) }}"
                     class="max-h-[400px] object-contain transition">
            </div>

            <!-- THUMBNAIL -->
            <div class="flex gap-3 flex-wrap">

                @foreach([$produk->gambar_1, $produk->gambar_2, $produk->gambar_3] as $img)
                    @if($img)
                    <img src="{{ asset('storage/' . $img) }}"
                         onclick="changeImage(this)"
                         class="w-20 h-20 object-contain bg-white border rounded-xl p-2 cursor-pointer hover:border-red-500 transition">
                    @endif
                @endforeach

            </div>

        </div>


        {{-- RIGHT - DETAIL --}}
        <div>

            <!-- BACK BUTTON (MODERN) -->
<div class="flex items-center gap-2 mb-4">

    <!-- BACK ICON -->
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('home') }}"
       class="text-gray-600 hover:text-red-600 transition">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M15 19l-7-7 7-7"/>
        </svg>
    </a>

    <!-- TITLE -->
    <h1 class="text-2xl md:text-3xl font-semibold text-gray-800 leading-snug">
        {{ $produk->nama_produk }}
    </h1>

</div>

            <!-- HARGA -->
            <p class="text-3xl font-bold text-red-600 mt-3">
                Rp {{ number_format($produk->harga) }}
            </p>

            <!-- DESKRIPSI (COLLAPSE) -->
            <div class="mt-6 text-gray-600 text-sm leading-relaxed">

                <div id="descShort">
                    {{ \Illuminate\Support\Str::limit($produk->deskripsi, 150) }}
                </div>

                <div id="descFull" class="hidden">
                    {!! nl2br(e($produk->deskripsi)) !!}
                </div>

                @if(strlen($produk->deskripsi) > 150)
                <button onclick="toggleDesc()"
                        class="text-red-600 mt-2 text-sm font-medium">
                    Lihat Selengkapnya
                </button>
                @endif

            </div>

            <!-- QTY -->
            <div class="mt-6">

                <p class="font-medium mb-2 text-gray-700">Jumlah</p>

                <div class="flex items-center gap-3">

                    <button onclick="minusQty()"
                            class="w-10 h-10 rounded-lg border flex items-center justify-center hover:bg-gray-100">
                        -
                    </button>

                    <input type="number" id="qty" value="1" min="1"
                           class="w-16 text-center border rounded-lg py-2">

                    <button onclick="plusQty()"
                            class="w-10 h-10 rounded-lg border flex items-center justify-center hover:bg-gray-100">
                        +
                    </button>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-8">

                @guest
                    <a href="{{ route('login') }}"
                       class="block text-center bg-red-600 text-white py-4 rounded-xl font-semibold">
                        Login untuk beli
                    </a>
                @else

                <div class="grid grid-cols-2 gap-4">

                    <!-- CART -->
                    <form action="{{ route('keranjang.store', $produk->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="qty" id="qty_cart">

                        <button type="submit" onclick="setQty('cart')"
                                class="w-full border border-gray-300 py-3 rounded-xl flex items-center justify-center gap-2 hover:bg-gray-50">

                            <!-- CART ICON -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                      d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                            </svg>

                            Keranjang
                        </button>
                    </form>

                    <!-- BUY -->
                    <form action="{{ route('checkout.index') }}" method="GET">
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="qty" id="qty_checkout">

                        <button type="submit" onclick="setQty('checkout')"
                                class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition">
                            Beli Sekarang
                        </button>
                    </form>

                </div>

                @endguest

            </div>

        </div>

    </div>

</div>

{{-- SCRIPT --}}
<script>

function changeImage(el) {
    document.getElementById('mainImage').src = el.src;
}

function plusQty() {
    let q = document.getElementById('qty');
    q.value = parseInt(q.value) + 1;
}

function minusQty() {
    let q = document.getElementById('qty');
    if(q.value > 1) q.value--;
}

function setQty(type) {
    let qty = document.getElementById('qty').value;

    if(type === 'cart'){
        document.getElementById('qty_cart').value = qty;
    } else {
        document.getElementById('qty_checkout').value = qty;
    }
}

function toggleDesc(){
    let short = document.getElementById('descShort');
    let full = document.getElementById('descFull');

    short.classList.toggle('hidden');
    full.classList.toggle('hidden');
}

</script>

@endsection
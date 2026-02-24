@extends('guest.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10">

    <h2 class="text-2xl font-bold text-[#F5AD1B] mb-6">
        Keranjang Saya
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($keranjang->count())

        @foreach ($keranjang as $item)

        <div class="bg-white rounded-xl shadow p-6 mb-6 flex items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-6">

                <input type="checkbox"
                       name="selected_items[]"
                       value="{{ $item->id }}"
                       form="checkoutForm"
                       class="item-checkbox w-5 h-5 accent-[#AA1B25]"
                       data-price="{{ $item->produk->harga }}"
                       data-qty="{{ $item->qty }}">

                <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                     class="w-20 h-20 object-cover rounded-lg">

                <div>
                    <p class="font-semibold">
                        {{ $item->produk->nama_produk }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        Rp {{ number_format($item->produk->harga) }}
                    </p>
                </div>

            </div>

            {{-- MIDDLE --}}
            <div class="flex items-center gap-6">

                <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center border rounded">
                    @csrf
                    <button type="submit" name="qty" value="{{ max(1, $item->qty - 1) }}"
                            class="px-3 py-1 bg-gray-200">−</button>

                    <input type="text" value="{{ $item->qty }}"
                           class="w-10 text-center outline-none" readonly>

                    <button type="submit" name="qty" value="{{ $item->qty + 1 }}"
                            class="px-3 py-1 bg-gray-200">+</button>
                </form>

                <p class="font-bold text-[#F5AD1B]">
                    Rp {{ number_format($item->qty * $item->produk->harga) }}
                </p>

            </div>

            {{-- RIGHT --}}
            <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg">
                    Hapus
                </button>
            </form>

        </div>

        @endforeach

        {{-- FORM CHECKOUT HANYA DI RINGKASAN --}}
        <form action="{{ route('checkout.index') }}" method="GET" id="checkoutForm">

            <div class="bg-white rounded-xl shadow p-6 mt-6 flex justify-between items-center">

                <div>
                    <p class="text-gray-600">Ringkasan Belanja</p>
                    <p class="text-sm text-gray-500">Total Pembayaran</p>

                    <p id="totalHarga"
                       class="text-xl font-bold text-[#AA1B25] mt-2">
                        Rp 0
                    </p>
                </div>

                <button type="submit"
                        class="bg-[#AA1B25] text-white px-8 py-4 rounded-xl text-lg font-semibold">
                    Checkout
                </button>

            </div>

        </form>

    @else

        <div class="bg-white rounded-xl shadow p-10 text-center">
            Keranjang kosong
        </div>

    @endif

</div>

<script>
    const checkoutBtn = document.querySelector('#checkoutForm button');

    function toggleCheckout() {
        let checked = false;

        checkboxes.forEach(cb => {
            if (cb.checked) checked = true;
        });

        checkoutBtn.disabled = !checked;
        checkoutBtn.classList.toggle('opacity-50', !checked);
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            hitungTotal();
            toggleCheckout();
        });
    });

    toggleCheckout();
</script>

@endsection
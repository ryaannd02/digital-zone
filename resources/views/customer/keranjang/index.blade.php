@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    <!-- HEADER -->
<div class="flex items-center gap-3 mb-8">

    <!-- BACK BUTTON -->
<a href="#"
   onclick="event.preventDefault(); 
            if (window.history.length > 1) { 
                history.back(); 
            } else { 
                window.location.href='{{ route('dashboard') }}'; 
            }"
   class="p-1 rounded-lg text-gray-600 hover:text-red-600 hover:bg-gray-100 transition">

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
    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">
        Keranjang Saya
    </h2>

</div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($keranjang->count())

        @foreach ($keranjang as $item)

        <div class="bg-white rounded-2xl border hover:shadow-md transition p-4 md:p-6 mb-4">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <!-- LEFT -->
                <div class="flex items-center gap-4">

                    <input type="checkbox"
                        name="selected_items[]"
                        value="{{ $item->id }}"
                        form="checkoutForm"
                        class="item-checkbox w-5 h-5 accent-red-600"
                        data-price="{{ $item->produk->harga }}"
                        data-qty="{{ $item->qty }}">

                    <!-- IMAGE FIX -->
                    <div class="w-20 h-20 bg-gray-50 rounded-xl flex items-center justify-center p-2 border">
                        <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                             class="max-h-full max-w-full object-contain">
                    </div>

                    <!-- INFO -->
                    <div>
                        <p class="font-medium text-gray-800">
                            {{ $item->produk->nama_produk }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Rp {{ number_format($item->produk->harga) }}
                        </p>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="flex items-center justify-between md:justify-end gap-4">

<!-- QTY -->
<form class="flex items-center border rounded-lg overflow-hidden">

    <!-- MINUS -->
    <button type="button"
        onclick="updateQty({{ $item->id }}, Math.max(1, parseInt(document.getElementById('qty-{{ $item->id }}').value) - 1))"
        class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
        −
    </button>

    <!-- INPUT -->
    <input id="qty-{{ $item->id }}"
           type="text"
           value="{{ $item->qty }}"
           class="w-10 text-center outline-none text-sm"
           readonly>

    <!-- PLUS -->
    <button type="button"
        onclick="updateQty({{ $item->id }}, parseInt(document.getElementById('qty-{{ $item->id }}').value) + 1)"
        class="px-3 py-1 bg-gray-100 hover:bg-gray-200">
        +
    </button>

</form>

                    <!-- DELETE -->
                    <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>

                </div>

            </div>

        </div>

        @endforeach


        <!-- SUMMARY -->
        <form action="{{ route('checkout.index') }}" method="GET" id="checkoutForm">

            <div class="bg-white rounded-2xl border p-6 mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div>
                    <p class="text-sm text-gray-500">Ringkasan Belanja</p>
                    <p class="text-xs text-gray-400">Total Pembayaran</p>

                    <p id="totalHarga"
                       class="text-2xl font-bold text-red-600 mt-2">
                        Rp 0
                    </p>
                </div>

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 transition text-white px-8 py-3 rounded-xl text-sm md:text-base font-semibold disabled:opacity-50">
                    Checkout
                </button>

            </div>

        </form>

    @else

        <!-- EMPTY -->
        <div class="bg-white rounded-2xl border p-12 text-center flex flex-col items-center gap-3 text-gray-400">

            <svg xmlns="http://www.w3.org/2000/svg" 
                class="w-5 h-5" 
                fill="none" 
                viewBox="0 0 24 24" 
                stroke="currentColor">

                <path stroke-linecap="round" 
                    stroke-linejoin="round" 
                    stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 100-2 
                        1 1 0 000 2zm7 0a1 1 0 100-2 
                        1 1 0 000 2z"/>
            </svg>

            <p class="text-sm">Keranjang kamu masih kosong</p>

        </div>

    @endif

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const checkboxes = document.querySelectorAll('.item-checkbox');
    const totalEl = document.getElementById('totalHarga');

    function hitungTotal() {
        let total = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const harga = parseInt(cb.dataset.price);
                const qty = parseInt(cb.dataset.qty);
                total += harga * qty;
            }
        });

        totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', hitungTotal);
    });

    // 🔥 FIX UTAMA DI SINI
    window.updateQty = function(id, qty) {

        fetch(`/keranjang/${id}`, {
            method: 'PUT', // 🔥 FIX
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                qty: qty
            })
        })
        .then(res => res.json())
        .then(() => {

            const qtyInput = document.querySelector(`#qty-${id}`);
            if (qtyInput) qtyInput.value = qty;

            const checkbox = document.querySelector(`.item-checkbox[value="${id}"]`);
            if (checkbox) checkbox.dataset.qty = qty;

            hitungTotal();
        })
        .catch(err => {
            console.error(err);
            alert('Gagal update qty'); // 🔥 biar keliatan error
        });
    }

});
</script>

@endsection
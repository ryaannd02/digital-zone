@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    <!-- HEADER -->
<h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-3">

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

    Checkout

</h2>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        {{-- HIDDEN (TIDAK DIUBAH) --}}
        @if(!empty($selectedItems))
            @foreach($selectedItems as $id)
                <input type="hidden" name="selected_items[]" value="{{ $id }}">
            @endforeach
        @endif

        @if(empty($selectedItems))
            <input type="hidden" name="produk_id" value="{{ $items[0]->produk->id }}">
            <input type="hidden" name="qty" value="{{ $items[0]->qty }}">
        @endif

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="lg:col-span-2 space-y-6">

                <!-- ALAMAT -->
                <div class="bg-white border rounded-2xl p-6">

                    <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">

                        <!-- ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-red-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243A8 8 0 1117.657 16.657z"/>
                        </svg>

                        Alamat Pengiriman

                    </h3>

                    @foreach($alamats as $alamat)

                    <label class="flex gap-3 border rounded-xl p-4 mb-3 cursor-pointer hover:border-red-500 transition">

                        <input type="radio"
                               name="alamat_id"
                               value="{{ $alamat->id }}"
                               {{ $alamat->is_primary ? 'checked' : '' }}
                               class="mt-1">

                        <div>

                            <p class="font-semibold text-gray-800">
                                {{ $alamat->nama_penerima }}
                                <span class="text-xs text-gray-500">({{ $alamat->label }})</span>
                            </p>

                            <p class="text-sm text-gray-600 mt-1">
                                {{ $alamat->alamat_lengkap }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $alamat->no_telepon }}
                            </p>

                        </div>

                    </label>

                    @endforeach

                </div>


                <!-- PRODUK -->
                <div class="bg-white border rounded-2xl p-6">

                    <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">

                        <!-- ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-red-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
                        </svg>

                        Produk Dipesan

                    </h3>

                    @foreach($items as $item)

                    <div class="flex justify-between items-center border-b py-4 last:border-none">

                        <div class="flex items-center gap-4">

                            <div class="w-16 h-16 bg-gray-50 rounded-xl flex items-center justify-center p-2">
                                <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                                     class="max-h-full object-contain">
                            </div>

                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $item->produk->nama_produk }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Rp {{ number_format($item->produk->harga) }} × {{ $item->qty }}
                                </p>
                            </div>

                        </div>

                        <p class="font-semibold text-gray-800">
                            Rp {{ number_format($item->qty * $item->produk->harga) }}
                        </p>

                    </div>

                    @endforeach

                </div>


                <!-- PENGIRIMAN -->
                <div class="bg-white border rounded-2xl p-6">

                    <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">

                        <!-- ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-red-600"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 17v-6h13v6M9 17H5a2 2 0 01-2-2v-5h6m0 0V5a2 2 0 012-2h2"/>
                        </svg>

                        Metode Pengiriman

                    </h3>

                    @foreach([
                        ['reguler','1-3 hari kerja',14000],
                        ['besok','1 hari kerja',22000],
                        ['ekonomis','1-7 hari kerja',8000]
                    ] as $index => $layanan)

                    <label class="flex justify-between border rounded-xl p-4 mb-3 cursor-pointer hover:border-red-500">

                        <div class="flex items-center gap-3">
                            <input type="radio"
                                   name="layanan"
                                   value="{{ $layanan[0] }}"
                                   data-ongkir="{{ $layanan[2] }}"
                                   class="layanan-radio"
                                   {{ $index==0 ? 'checked' : '' }}>

                            <span class="text-sm text-gray-700">
                                {{ ucfirst($layanan[0]) }} ({{ $layanan[1] }})
                            </span>
                        </div>

                        <span class="font-medium text-gray-800">
                            Rp {{ number_format($layanan[2]) }}
                        </span>

                    </label>

                    @endforeach

                </div>

            </div>


            <!-- RIGHT -->
            <div class="bg-white border rounded-2xl p-6 h-fit sticky top-24">

                <h3 class="font-semibold text-lg mb-5">
                    Ringkasan Belanja
                </h3>

                <div class="flex justify-between text-sm mb-3">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp {{ number_format($subtotal) }}</span>
                </div>

                <div class="flex justify-between text-sm mb-3">
                    <span>Ongkir</span>
                    <span id="ongkirText">Rp 14.000</span>
                </div>

                <hr class="my-4">

                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span id="totalText">
                        Rp {{ number_format($subtotal + 14000) }}
                    </span>
                </div>

                <button type="submit"
                        class="w-full mt-6 bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition">
                    Bayar Sekarang
                </button>

            </div>

        </div>

    </form>

</div>


{{-- ========================= --}}
{{-- SCRIPT --}}
{{-- ========================= --}}
<script>

    const subtotal = {{ $subtotal }};
    const radios = document.querySelectorAll('.layanan-radio');
    const ongkirText = document.getElementById('ongkirText');
    const totalText = document.getElementById('totalText');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function updateTotal() {
        let selected = document.querySelector('.layanan-radio:checked');
        let ongkir = parseInt(selected.dataset.ongkir);

        ongkirText.innerText = "Rp " + formatRupiah(ongkir);
        totalText.innerText = "Rp " + formatRupiah(subtotal + ongkir);
    }

    radios.forEach(radio => {
        radio.addEventListener('change', updateTotal);
    });

</script>

@endsection
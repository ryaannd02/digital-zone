@extends('guest.layout')

@section('content')

<div class="max-w-6xl mx-auto py-10">

    <h2 class="text-2xl font-bold text-[#F5AD1B] mb-8">
        Checkout
    </h2>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <div class="grid grid-cols-3 gap-8">

            {{-- ========================= --}}
            {{-- LEFT SECTION --}}
            {{-- ========================= --}}
            <div class="col-span-2 space-y-8">

                {{-- ========================= --}}
                {{-- ALAMAT --}}
                {{-- ========================= --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="font-semibold mb-4 text-lg">
                        Alamat Pengiriman
                    </h3>

                    @foreach($alamats as $alamat)
                        <label class="block border p-4 rounded-lg mb-3 cursor-pointer hover:border-[#AA1B25]">

                            <input type="radio"
                                   name="alamat_id"
                                   value="{{ $alamat->id }}"
                                   {{ $alamat->is_primary ? 'checked' : '' }}
                                   class="mr-2">

                            <span class="font-semibold">
                                {{ $alamat->nama_penerima }}
                            </span>
                            ({{ $alamat->label }})

                            <div class="text-sm text-gray-600 mt-1">
                                {{ $alamat->alamat_lengkap }}
                                <br>
                                {{ $alamat->no_telepon }}
                            </div>

                        </label>
                    @endforeach
                </div>

                {{-- ========================= --}}
                {{-- PRODUK --}}
                {{-- ========================= --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="font-semibold mb-4 text-lg">
                        Produk Dipesan
                    </h3>

                    @foreach($items as $item)

                        <div class="flex justify-between items-center border-b py-4">

                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                                     class="w-16 h-16 object-cover rounded">

                                <div>
                                    <p class="font-semibold">
                                        {{ $item->produk->nama_produk }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Rp {{ number_format($item->produk->harga) }}
                                        x {{ $item->qty }}
                                    </p>
                                </div>
                            </div>

                            <div class="font-bold">
                                Rp {{ number_format($item->qty * $item->produk->harga) }}
                            </div>

                        </div>

                        {{-- Hidden selected items --}}
                        <input type="hidden"
                               name="selected_items[]"
                               value="{{ $item->id }}">

                    @endforeach
                </div>

                {{-- ========================= --}}
                {{-- PENGIRIMAN --}}
                {{-- ========================= --}}
                <div class="bg-white p-6 rounded-xl shadow">
                    <h3 class="font-semibold mb-4 text-lg">
                        Metode Pengiriman (JNE)
                    </h3>

                    <label class="block mb-3">
                        <input type="radio"
                               name="layanan"
                               value="reguler"
                               data-ongkir="14000"
                               class="mr-2 layanan-radio"
                               checked>
                        Reguler (1-3 hari kerja) - Rp 14.000
                    </label>

                    <label class="block mb-3">
                        <input type="radio"
                               name="layanan"
                               value="besok"
                               data-ongkir="22000"
                               class="mr-2 layanan-radio">
                        Besok Sampai (1 hari kerja) - Rp 22.000
                    </label>

                    <label class="block">
                        <input type="radio"
                               name="layanan"
                               value="ekonomis"
                               data-ongkir="8000"
                               class="mr-2 layanan-radio">
                        Ekonomis (1-7 hari kerja) - Rp 8.000
                    </label>
                </div>

            </div>

            {{-- ========================= --}}
            {{-- RIGHT SECTION --}}
            {{-- ========================= --}}
            <div class="bg-white p-6 rounded-xl shadow h-fit">

                <h3 class="font-semibold mb-6 text-lg">
                    Ringkasan Belanja
                </h3>

                <div class="flex justify-between mb-3">
                    <span>Subtotal</span>
                    <span id="subtotal">
                        Rp {{ number_format($subtotal) }}
                    </span>
                </div>

                <div class="flex justify-between mb-3">
                    <span>Ongkir</span>
                    <span id="ongkirText">
                        Rp 14.000
                    </span>
                </div>

                <hr class="my-4">

                <div class="flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span id="totalText">
                        Rp {{ number_format($subtotal + 14000) }}
                    </span>
                </div>

                <button type="submit"
                        class="w-full mt-6 bg-[#AA1B25] text-white py-3 rounded-xl font-semibold hover:opacity-90">
                    Bayar Sekarang
                </button>

            </div>

        </div>

    </form>

</div>


{{-- ========================= --}}
{{-- SCRIPT UPDATE TOTAL --}}
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
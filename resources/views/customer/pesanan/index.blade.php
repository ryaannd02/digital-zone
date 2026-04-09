@extends('customer.layout')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-4 md:px-6"
     x-data="{ tab: 'semua', detailOpen: false, selectedOrder: null }">

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
    <h2 class="text-2xl font-bold text-gray-800">
        Pesanan Saya
    </h2>

</div>

    <!-- TAB -->
    <div class="flex flex-wrap gap-3 mb-8">

        <template x-for="item in ['semua','tertunda','diproses','dikirim','selesai','gagal']">
            <button @click="tab=item"
                :class="tab==item
                ? 'bg-red-600 text-white'
                : 'bg-white border text-gray-600 hover:bg-gray-50'"
                class="px-4 py-2 rounded-xl text-sm capitalize transition">
                <span x-text="item"></span>
            </button>
        </template>

    </div>

    <!-- LIST -->
    @forelse($pesanans as $order)

    <div x-show="tab=='semua' || tab=='{{ $order->order_status }}'"
         class="bg-white rounded-2xl border border-gray-100 p-5 mb-6 
       hover:shadow-lg transition duration-200">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-4">

                    <div>
            <div class="flex items-center gap-3">

                <!-- ICON -->
                <div class="w-8 h-8 flex items-center justify-center bg-red-50 rounded-lg flex-shrink-0">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 text-red-600"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round">

                        <path d="M4 3h16v18l-2-1-2 1-2-1-2 1-2-1-2 1-2-1-2 1V3z"/>
                        <line x1="8" y1="7" x2="16" y2="7"/>
                        <line x1="8" y1="11" x2="16" y2="11"/>
                        <line x1="8" y1="15" x2="13" y2="15"/>

                    </svg>

                </div>

                <!-- TEXT -->
                <p class="font-semibold text-gray-800">
                    Order {{ $order->kode }}
                </p>

            </div>

            <p class="text-xs text-gray-500 mt-1 ml-11">
                {{ $order->created_at->format('d M Y H:i') }}
            </p>
        </div>

            <div class="flex gap-2 flex-wrap">

                <span class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600">
                    {{ strtoupper($order->payment_status) }}
                </span>

                <span class="text-xs px-3 py-1 rounded-full
                    {{ $order->order_status == 'gagal'
                        ? 'bg-red-100 text-red-600'
                        : 'bg-blue-100 text-blue-600' }}">
                    {{ strtoupper($order->order_status) }}
                </span>

            </div>

        </div>

        <!-- PRODUK -->
        @foreach($order->details as $item)

        <div class="space-y-4 border-t pt-4">

    @foreach($order->details as $item)
    <div class="flex gap-4 items-center">

        <div class="w-20 h-20 bg-gray-50 rounded-xl flex items-center justify-center p-2">
            <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                 class="max-h-full object-contain">
        </div>

        <div class="flex-1">
            <p class="font-medium text-gray-800 line-clamp-1">
                {{ $item->produk->nama_produk }}
            </p>

            <div class="flex items-center gap-4 text-sm text-gray-500 mt-1">
                <span>Qty: {{ $item->qty }}</span>
            </div>

            <p class="font-semibold text-red-600 mt-1">
                Rp {{ number_format($item->produk->harga) }}
            </p>
        </div>

    </div>
    @endforeach

</div>

        @endforeach

{{-- TRACKING --}}
@if($order->order_status == 'dikirim')

<div class="mt-6 p-6 bg-white rounded-2xl border shadow-sm">

    <!-- HEADER -->
    <div class="flex items-center gap-2 mb-6">
        <div class="w-9 h-9 flex items-center justify-center bg-blue-50 rounded-xl">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5 text-blue-600"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round">

                <!-- body -->
                <rect x="1" y="7" width="13" height="10" rx="2"></rect>

                <!-- cabin -->
                <path d="M14 10h4l3 3v4h-7z"></path>

                <!-- wheels -->
                <circle cx="5.5" cy="18" r="1.5"></circle>
                <circle cx="17.5" cy="18" r="1.5"></circle>

            </svg>

        </div>
        <p class="font-semibold text-gray-800">
            Tracking Pengiriman
        </p>
    </div>

    @php
        $steps = ['pickup','perjalanan','menuju_alamat','sampai'];
        $currentIndex = array_search($order->tracking_status, $steps);
    @endphp

    <div class="relative flex justify-between items-center">

        <!-- LINE BACKGROUND -->
        <div class="absolute top-5 left-0 right-0 h-[3px] bg-gray-200 rounded-full"></div>

        <!-- LINE PROGRESS -->
        <div class="absolute top-5 left-0 h-[3px] bg-blue-600 rounded-full transition-all"
             style="width: {{ ($currentIndex / 3) * 100 }}%"></div>

        @foreach([
            'pickup'=>'Pickup',
            'perjalanan'=>'Perjalanan',
            'menuju_alamat'=>'Menuju',
            'sampai'=>'Sampai'
        ] as $key => $label)

        @php
            $index = array_search($key, $steps);
            $active = $index <= $currentIndex;
            $isCurrent = $key == $order->tracking_status;
        @endphp

        <div class="flex flex-col items-center flex-1 relative z-10">

            <!-- ICON WRAPPER -->
            <div class="w-11 h-11 flex items-center justify-center rounded-full border-2 transition
                {{ $active 
                    ? ($key == 'sampai'
                        ? 'bg-green-600 border-green-600 text-white'
                        : 'bg-blue-600 border-blue-600 text-white')
                    : 'bg-white border-gray-300 text-gray-400' }}">

                        @if($key == 'pickup')
                            <!-- BOX / PACKAGE -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="w-5 h-5" 
                                viewBox="0 0 24 24" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="1.8"
                                stroke-linecap="round" 
                                stroke-linejoin="round">
                                <path d="M3 7l9-4 9 4-9 4-9-4z"/>
                                <path d="M3 7v10l9 4 9-4V7"/>
                            </svg>

                        @elseif($key == 'perjalanan')
                            <!-- TRUCK -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="w-5 h-5" 
                                viewBox="0 0 24 24" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="1.8"
                                stroke-linecap="round" 
                                stroke-linejoin="round">
                                <path d="M3 7h11v10H3z"/>
                                <path d="M14 10h4l3 3v4h-7z"/>
                                <circle cx="7" cy="17" r="1.5"/>
                                <circle cx="17" cy="17" r="1.5"/>
                            </svg>

                        @elseif($key == 'menuju_alamat')
                            <!-- HOME -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="w-5 h-5" 
                                viewBox="0 0 24 24" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="1.8"
                                stroke-linecap="round" 
                                stroke-linejoin="round">
                                <path d="M3 11l9-7 9 7"/>
                                <path d="M5 10v10h14V10"/>
                                <path d="M9 20v-6h6v6"/>
                            </svg>

                        @else
                            <!-- CHECK -->
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                class="w-5 h-5" 
                                viewBox="0 0 24 24" 
                                fill="none" 
                                stroke="currentColor" 
                                stroke-width="2"
                                stroke-linecap="round" 
                                stroke-linejoin="round">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        @endif

            </div>

            <!-- LABEL -->
            <p class="mt-2 text-xs text-center
                {{ $active ? 'text-gray-800 font-medium' : 'text-gray-400' }}">
                {{ $label }}
            </p>

            <!-- CURRENT BADGE -->
            @if($isCurrent)
                <span class="mt-1 text-[10px] px-2 py-[2px] rounded-full bg-blue-100 text-blue-600">
                    sekarang
                </span>
            @endif

        </div>

        @endforeach

    </div>

</div>

@endif

        <!-- FOOTER -->
        <div class="mt-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <p class="font-semibold text-gray-800">
                    Total: Rp {{ number_format($order->total_bayar) }}
                </p>

                @if($order->payment_status == 'pending' && $order->expired_at)
                <p class="text-sm text-red-500 mt-1 countdown"
                   data-expired="{{ $order->expired_at }}">
                   Loading...
                </p>
                @endif
            </div>

            <div class="flex flex-wrap gap-2 items-center">

                {{-- ✅ PAKET DITERIMA --}}
                @if($order->order_status == 'dikirim' && $order->tracking_status == 'sampai')

                <form action="{{ route('customer.pesanan.selesai', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition">

                        <!-- ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 13l4 4L19 7"/>
                        </svg>

                        Paket Diterima
                    </button>
                </form>

                @endif


                {{-- ❌ BAYAR LAGI --}}
                @if($order->payment_status == 'pending')
                <a href="{{ route('checkout.retry', $order->id) }}"
                class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 10h18M7 15h1m4 0h1"/>
                    </svg>

                    Bayar Lagi
                </a>
                @endif


                {{-- DETAIL --}}
                <button @click="detailOpen = true; selectedOrder = {{ $order->toJson() }}"
                    class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm transition">

                    <!-- ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"/>
                    </svg>

                    Detail
                </button>

            </div>

        </div>

    </div>

    @empty
        <div class="text-center py-20 text-gray-400">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-12 h-12 mx-auto mb-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4"/>
            </svg>

            Belum ada pesanan

        </div>
    @endforelse


<!-- MODAL -->
<div x-show="detailOpen"
     x-transition
     x-cloak
     @click.self="detailOpen = false"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">

    <div class="bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto 
                p-6 rounded-3xl shadow-2xl relative">

        <!-- CLOSE BUTTON -->
        <button @click="detailOpen = false"
                class="absolute top-4 right-4 w-9 h-9 flex items-center justify-center 
                       rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-700 transition">
            ✕
        </button>

        <!-- HEADER -->
        <div class="mb-5">
            <h3 class="text-xl font-bold text-gray-800">
                Detail Pesanan
            </h3>
            <p class="text-sm text-gray-500">
                Informasi lengkap pesanan pelanggan
            </p>
        </div>

        <template x-if="selectedOrder">
        <div class="text-sm text-gray-700 space-y-5">

            <!-- CUSTOMER INFO -->
            <div class="bg-gray-50 p-4 rounded-xl space-y-2">
                <h4 class="font-semibold text-gray-800 mb-2">Informasi Pelanggan</h4>
                <p><span class="text-gray-500">Nama:</span> <span class="font-medium" x-text="selectedOrder.user.name"></span></p>
                <p><span class="text-gray-500">Email:</span> <span x-text="selectedOrder.user.email"></span></p>
                <p><span class="text-gray-500">Telepon:</span> <span x-text="selectedOrder.alamat.no_telepon"></span></p>
                <p><span class="text-gray-500">Alamat:</span> <span x-text="selectedOrder.alamat.alamat_lengkap"></span></p>
            </div>

            <!-- PAYMENT -->
            <div class="bg-blue-50 p-4 rounded-xl flex justify-between items-center">
                <span class="font-medium text-blue-700">Metode Pembayaran</span>
                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold"
                      x-text="selectedOrder.payment_detail"></span>
            </div>

            <!-- ORDER ITEMS -->
            <div>
                <h4 class="font-semibold text-gray-800 mb-3">Item Pesanan</h4>

                <div class="space-y-3">
                    <template x-for="item in selectedOrder.details">
                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                            <span class="font-medium"
                                  x-text="item.produk.nama_produk + ' x' + item.qty"></span>
                            <span class="text-gray-600"
                                  x-text="'Rp ' + item.harga"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- TOTAL -->
            <div class="border-t pt-4 space-y-2">
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span class="text-green-600"
                          x-text="'Rp ' + selectedOrder.total_bayar"></span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Status</span>
                    <span class="px-3 py-1 text-xs rounded-full font-semibold"
                          :class="{
                              'bg-yellow-100 text-yellow-700': selectedOrder.order_status == 'pending',
                              'bg-green-100 text-green-700': selectedOrder.order_status == 'selesai',
                              'bg-red-100 text-red-700': selectedOrder.order_status == 'batal'
                          }"
                          x-text="selectedOrder.order_status">
                    </span>
                </div>
            </div>

            <a href="{{ route('customer.pesanan.invoice', $order->id) }}"
            class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm transition">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 16v-8M8 12l4 4 4-4"/>
                </svg>

                Invoice
            </a>

        </div>
        </template>

    </div>

</div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    function startCountdown() {
        document.querySelectorAll('.countdown').forEach(function (el) {

            const expiredAt = new Date(el.dataset.expired).getTime();

            function update() {
                const now = new Date().getTime();
                const distance = expiredAt - now;

                if (distance <= 0) {
                    el.innerHTML = "Waktu habis";
                    return;
                }

                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                el.innerHTML = `Sisa waktu: ${minutes}m ${seconds}s`;
            }

            update();
            setInterval(update, 1000);
        });
    }

    startCountdown();
});
</script>

@endsection
@extends('customer.layout')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-4 md:px-6"
     x-data="{ tab: 'semua', detailOpen: false, selectedOrder: null }">

    <!-- HEADER -->
<div class="flex items-center gap-3 mb-8">

    <!-- BACK BUTTON -->
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('customer.dashboard') }}"
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
         class="bg-white rounded-2xl border p-6 mb-6 hover:shadow-md transition">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-4">

            <div>
                <p class="font-semibold text-gray-800">
                    Order {{ $order->kode }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
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

        <div class="flex gap-4 border-t pt-4">

            <div class="w-20 h-20 bg-gray-50 rounded-xl flex items-center justify-center p-2">
                <img src="{{ asset('storage/' . $item->produk->gambar_1) }}"
                     class="max-h-full max-w-full object-contain">
            </div>

            <div class="flex-1">
                <p class="font-medium text-gray-800">
                    {{ $item->produk->nama_produk }}
                </p>
                <p class="text-sm text-gray-500">
                    Qty: {{ $item->qty }}
                </p>
                <p class="font-semibold text-red-600 mt-1">
                    Rp {{ number_format($item->produk->harga) }}
                </p>
            </div>

        </div>

        @endforeach

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

            <div class="flex gap-2 flex-wrap">

                @if($order->payment_status == 'pending')
                <a href="{{ route('checkout.retry', $order->id) }}"
                   class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-sm transition">
                    Bayar Lagi
                </a>
                @endif

                <button @click="detailOpen = true; selectedOrder = {{ $order->toJson() }}"
                        class="border border-gray-300 hover:bg-gray-50 px-4 py-2 rounded-xl text-sm transition">
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
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div class="bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 rounded-2xl shadow-lg relative">

            <!-- CLOSE -->
            <button @click="detailOpen = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-xl">
                &times;
            </button>

            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Detail Pesanan
            </h3>

            <template x-if="selectedOrder">
            <div class="text-sm space-y-2">

                <p><b>Nama:</b> <span x-text="selectedOrder.user.name"></span></p>
                <p><b>Email:</b> <span x-text="selectedOrder.user.email"></span></p>
                <p><b>Telepon:</b> <span x-text="selectedOrder.alamat.no_telepon"></span></p>
                <p><b>Alamat:</b> <span x-text="selectedOrder.alamat.alamat_lengkap"></span></p>
                <p><b>Pembayaran:</b> <span x-text="selectedOrder.payment_detail"></span></p>

                <hr class="my-3">

                <template x-for="item in selectedOrder.details">
                    <div class="flex justify-between">
                        <span x-text="item.produk.nama_produk + ' x' + item.qty"></span>
                        <span x-text="'Rp ' + item.harga"></span>
                    </div>
                </template>

                <hr class="my-3">

                <p><b>Total:</b> Rp <span x-text="selectedOrder.total_bayar"></span></p>
                <p><b>Status:</b> <span x-text="selectedOrder.order_status"></span></p>

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
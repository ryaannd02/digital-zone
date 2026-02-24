@extends('guest.layout')

@section('content')

<div class="max-w-6xl mx-auto py-10" x-data="{ detailOpen: false, receiptOpen: false, selectedOrder: null }">

    <h2 class="text-2xl font-bold mb-6">Pesanan Saya</h2>

    {{-- ================= FILTER ================= --}}
    <form method="GET" class="bg-white p-4 rounded shadow mb-8 grid grid-cols-4 gap-4">

        <input type="date" name="from" value="{{ request('from') }}" class="border p-2 rounded">
        <input type="date" name="to" value="{{ request('to') }}" class="border p-2 rounded">

        <select name="payment_status" class="border p-2 rounded">
            <option value="">Semua Status Bayar</option>
            <option value="pending">Pending</option>
            <option value="paid">Paid</option>
            <option value="failed">Failed</option>
        </select>

        <select name="order_status" class="border p-2 rounded">
            <option value="">Semua Status Order</option>
            <option value="tertunda">Tertunda</option>
            <option value="diproses">Diproses</option>
            <option value="dikirim">Dikirim</option>
            <option value="selesai">Selesai</option>
        </select>

        <button class="col-span-4 bg-[#AA1B25] text-white py-2 rounded">
            Terapkan Filter
        </button>

    </form>

    {{-- ================= LIST PESANAN ================= --}}
    @foreach($pesanans as $order)

    <div class="bg-white p-6 rounded-xl shadow mb-6">

        <div class="flex justify-between items-center mb-4">
            <div>
                <p class="font-semibold">Order #{{ $order->id }}</p>
                <p class="text-sm text-gray-500">
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div class="text-right">
                <span class="px-3 py-1 text-sm rounded bg-green-100 text-green-700">
                    {{ strtoupper($order->payment_status) }}
                </span>

                <span class="px-3 py-1 text-sm rounded bg-blue-100 text-blue-700">
                    {{ strtoupper($order->order_status) }}
                </span>
            </div>
        </div>

        <p class="font-bold mb-4">
            Total: Rp {{ number_format($order->total_bayar) }}
        </p>

        <div class="flex gap-4">
            <button @click="detailOpen = true; selectedOrder = {{ $order->toJson() }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Lihat Detail
            </button>

            <button @click="receiptOpen = true; selectedOrder = {{ $order->toJson() }}"
                    class="bg-gray-800 text-white px-4 py-2 rounded">
                Cetak Struk
            </button>
        </div>

    </div>

    @endforeach


    {{-- ================= MODAL DETAIL ================= --}}
    <div 
        x-show="detailOpen"
        x-transition
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >

        <div class="bg-white w-2/3 max-h-[90vh] overflow-y-auto p-8 rounded-xl shadow relative">

            <button 
                @click="detailOpen = false"
                class="absolute top-4 right-6 text-2xl font-bold">
                &times;
            </button>

            <h3 class="text-xl font-bold mb-6">Detail Pesanan</h3>

            <template x-if="selectedOrder">
            <div>

                <p><b>Nama:</b> <span x-text="selectedOrder.user.name"></span></p>
                <p><b>Email:</b> <span x-text="selectedOrder.user.email"></span></p>
                <p><b>Telepon:</b> <span x-text="selectedOrder.alamat.no_hp"></span></p>
                <p><b>Alamat:</b> <span x-text="selectedOrder.alamat.alamat_lengkap"></span></p>

                <hr class="my-4">

                <p><b>Layanan:</b> <span x-text="selectedOrder.layanan_pengiriman"></span></p>
                <p><b>Ongkir:</b> Rp <span x-text="selectedOrder.ongkir"></span></p>

                <hr class="my-4">

                <template x-for="item in selectedOrder.details" :key="item.id">
                    <div class="flex justify-between mb-2">
                        <span x-text="item.produk.nama_produk + ' x' + item.qty"></span>
                        <span x-text="'Rp ' + item.harga"></span>
                    </div>
                </template>

                <hr class="my-4">

                <p><b>Subtotal:</b> Rp <span x-text="selectedOrder.total_harga"></span></p>
                <p><b>Total Bayar:</b> Rp <span x-text="selectedOrder.total_bayar"></span></p>

                <p><b>Status Pembayaran:</b> 
                    <span x-text="selectedOrder.payment_status"></span>
                </p>

                <p><b>Status Order:</b> 
                    <span x-text="selectedOrder.order_status"></span>
                </p>

                <p><b>Tanggal:</b> 
                    <span x-text="selectedOrder.created_at"></span>
                </p>

            </div>
            </template>

        </div>

    </div>


    {{-- ================= MODAL STRUK ================= --}}
    <div 
        x-show="receiptOpen"
        x-transition
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >

        <div class="bg-white w-1/2 p-8 rounded-xl shadow relative">

            <button 
                @click="receiptOpen = false"
                class="absolute top-4 right-6 text-2xl font-bold">
                &times;
            </button>

            <template x-if="selectedOrder">
            <div class="text-sm font-mono">

                <div class="text-center font-bold text-lg mb-2">
                    DIGITALZONE.COM
                </div>

                <hr class="my-2">

                <p>Order: #INV-<span x-text="selectedOrder.id"></span></p>
                <p>Tanggal: <span x-text="selectedOrder.created_at"></span></p>

                <hr class="my-2">

                <template x-for="item in selectedOrder.details" :key="item.id">
                    <div class="flex justify-between">
                        <span x-text="item.produk.nama_produk + ' x' + item.qty"></span>
                        <span x-text="'Rp ' + item.harga"></span>
                    </div>
                </template>

                <hr class="my-2">

                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span x-text="'Rp ' + selectedOrder.total_harga"></span>
                </div>

                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span x-text="'Rp ' + selectedOrder.ongkir"></span>
                </div>

                <div class="flex justify-between font-bold">
                    <span>TOTAL</span>
                    <span x-text="'Rp ' + selectedOrder.total_bayar"></span>
                </div>

                <hr class="my-2">

                <div class="text-center font-bold mt-2">
                    Status: <span x-text="selectedOrder.payment_status.toUpperCase()"></span>
                </div>

                <button 
                    onclick="window.print()" 
                    class="mt-6 bg-black text-white w-full py-2 rounded">
                    Print
                </button>

            </div>
            </template>

        </div>

    </div>

</div>

{{-- AlpineJS --}}
<script src="//unpkg.com/alpinejs" defer></script>

@endsection
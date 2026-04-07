@extends('petugas.layout')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">
        Detail Pesanan #{{ $pesanan->kode }}
    </h1>
    <p class="text-sm text-gray-500">Informasi lengkap pesanan</p>
</div>

<!-- GRID UTAMA -->
<div class="grid md:grid-cols-3 gap-6">

    <!-- LEFT (INFO + ALAMAT) -->
    <div class="md:col-span-2 space-y-6">

        <!-- INFO -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4"></i>
                Informasi Pesanan
            </h2>

            <div class="grid grid-cols-2 gap-4 text-sm">

                <div>
                    <p class="text-gray-500">Customer</p>
                    <p class="font-semibold text-gray-800">
                        {{ $pesanan->user->name }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tanggal</p>
                    <p class="font-semibold text-gray-800">
                        {{ $pesanan->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Status</p>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                        @if($pesanan->order_status == 'diproses') bg-yellow-100 text-yellow-700
                        @elseif($pesanan->order_status == 'dikirim') bg-blue-100 text-blue-700
                        @elseif($pesanan->order_status == 'selesai') bg-green-100 text-green-700
                        @endif">

                        @if($pesanan->order_status == 'diproses')
                            <i data-lucide="package" class="w-3 h-3"></i>
                        @elseif($pesanan->order_status == 'dikirim')
                            <i data-lucide="truck" class="w-3 h-3"></i>
                        @elseif($pesanan->order_status == 'selesai')
                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                        @endif

                        {{ $pesanan->order_status }}
                    </span>
                </div>

                <div>
                    <p class="text-gray-500">Payment</p>
                    <p class="font-semibold text-gray-800">
                        {{ $pesanan->payment_status }}
                    </p>
                </div>

                <div class="col-span-2">
                    <p class="text-gray-500">Metode Pembayaran</p>
                    <p class="font-semibold text-gray-800">
                        {{ $pesanan->payment_detail ?? '-' }}
                    </p>
                </div>

            </div>

        </div>

        <!-- ALAMAT -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <h2 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4"></i>
                Alamat Pengiriman
            </h2>

            <p class="font-semibold text-gray-800">
                {{ $pesanan->alamat->nama_penerima ?? '-' }}
            </p>

            <p class="text-sm text-gray-600">
                {{ $pesanan->alamat->no_telepon ?? '-' }}
            </p>

            <p class="text-sm text-gray-600 mt-1">
                {{ $pesanan->alamat->alamat_lengkap ?? '-' }}
            </p>

        </div>

        <!-- PRODUK -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="box" class="w-4 h-4"></i>
                Produk
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-gray-600 text-xs uppercase">
                        <tr>
                            <th class="p-3 text-left">Produk</th>
                            <th class="text-left">Harga</th>
                            <th class="text-left">Qty</th>
                            <th class="text-left">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($pesanan->details as $d)
                        <tr class="hover:bg-gray-50">

                            <td class="p-3 font-medium text-gray-800">
                                {{ $d->produk->nama_produk }}
                            </td>

                            <td>Rp {{ number_format($d->harga) }}</td>

                            <td>{{ $d->qty }}</td>

                            <td class="font-medium text-gray-800">
                                Rp {{ number_format($d->harga * $d->qty) }}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

    <!-- RIGHT (TOTAL + ACTION) -->
    <div class="space-y-6">

        <!-- TOTAL -->
<!-- TOTAL -->
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

    <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
        <i data-lucide="credit-card" class="w-4 h-4"></i>
        Ringkasan Pembayaran
    </h2>

    <div class="space-y-2 text-sm">

        <!-- TOTAL HARGA -->
        <div class="flex justify-between">
            <span class="text-gray-500">Total Harga</span>
            <span>Rp {{ number_format($pesanan->total_harga) }}</span>
        </div>

        <!-- ONGKIR -->
        <div class="flex justify-between">
            <span class="text-gray-500">Ongkir</span>
            <span>Rp {{ number_format($pesanan->ongkir) }}</span>
        </div>

        <hr class="my-2">

        <!-- TOTAL BAYAR -->
        <div class="flex justify-between items-center font-semibold">
            <span class="text-gray-800">Total Bayar</span>
            <span class="text-[#AA1B25] text-lg">
                Rp {{ number_format($pesanan->total_bayar) }}
            </span>
        </div>

    </div>

</div>

        <!-- UPDATE STATUS -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

    <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
        <i data-lucide="settings" class="w-4 h-4"></i>
        Update Status
    </h2>

    @if($pesanan->order_status !== 'selesai')

        @php
            $nextStatus = null;

            if ($pesanan->order_status === 'diproses') {
                $nextStatus = 'dikirim';
            } elseif ($pesanan->order_status === 'dikirim') {
                $nextStatus = 'selesai';
            }
        @endphp

        @if($nextStatus)
        <form method="POST"
              action="{{ route('petugas.pesanan.updateStatus', $pesanan->id) }}"
              class="space-y-3">
            @csrf
            @method('PATCH')

            <!-- INFO -->
            <div class="text-sm text-gray-600">
                {{ ucfirst($pesanan->order_status) }}
                <span class="mx-1 text-gray-400">→</span>
                <span class="font-semibold text-green-600">
                    {{ ucfirst($nextStatus) }}
                </span>
            </div>

            <!-- HIDDEN -->
            <input type="hidden" name="order_status" value="{{ $nextStatus }}">

            <!-- BUTTON -->
            <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition flex items-center justify-center gap-2">
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                Update ke {{ ucfirst($nextStatus) }}
            </button>

        </form>
        @endif

    @else
        <p class="text-green-600 font-semibold flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            Pesanan sudah selesai
        </p>
    @endif

</div>

    </div>

</div>

@endsection
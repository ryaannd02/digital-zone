@extends('admin.layout')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="receipt"></i>
            Detail Pesanan #{{ $pesanan->kode }}
        </h1>
        <p class="text-sm text-gray-500 mt-1">Informasi lengkap pesanan</p>
    </div>

    <a href="{{ route('admin.pesanan.invoice', $pesanan->id) }}"
       class="flex items-center gap-2 bg-slate-900 text-white px-4 py-2 rounded-xl text-sm hover:bg-slate-800 transition">
        <i data-lucide="download"></i>
        Invoice
    </a>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-6 rounded-xl">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-50 border border-red-200 text-red-700 p-4 mb-6 rounded-xl">
    {{ session('error') }}
</div>
@endif

<!-- GRID -->
<div class="grid lg:grid-cols-3 gap-6 mb-6">

    <!-- INFO -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

        <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i data-lucide="info"></i>
            Informasi Pesanan
        </h2>

<div class="grid md:grid-cols-2 gap-6 text-sm">

    <!-- USER -->
    <div>
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="user" class="w-4 h-4"></i>
            User
        </p>
        <p class="font-medium text-gray-800">
            {{ $pesanan->user->name }}
        </p>
    </div>

    <!-- TANGGAL -->
    <div>
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="calendar" class="w-4 h-4"></i>
            Tanggal
        </p>
        <p class="font-medium text-gray-800">
            {{ $pesanan->created_at->format('d M Y') }}
        </p>
    </div>

    <!-- JAM -->
    <div>
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="clock" class="w-4 h-4"></i>
            Waktu
        </p>
        <p class="font-medium text-gray-800">
            {{ $pesanan->created_at->format('H:i') }}
        </p>
    </div>

    <!-- PENGIRIMAN -->
    <div>
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="truck" class="w-4 h-4"></i>
            Pengiriman
        </p>
        <p class="font-medium text-gray-800">
            {{ ucfirst($pesanan->layanan_pengiriman) }}
        </p>
    </div>

    <!-- METODE PEMBAYARAN -->
    <div class="md:col-span-2">
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="credit-card" class="w-4 h-4"></i>
            Metode Pembayaran
        </p>
        <p class="font-semibold text-gray-800">
            {{ $pesanan->payment_detail ?? '-' }}
        </p>
    </div>

    <!-- STATUS -->
    <div>
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="activity" class="w-4 h-4"></i>
            Status
        </p>
        <span class="px-3 py-1 rounded-full text-xs font-medium text-white flex items-center gap-1 w-fit
            @if($pesanan->order_status == 'tertunda') bg-gray-500
            @elseif($pesanan->order_status == 'diproses') bg-slate-700
            @elseif($pesanan->order_status == 'dikirim') bg-amber-500
            @else bg-green-600
            @endif">
            {{ ucfirst($pesanan->order_status) }}
        </span>
    </div>

    <!-- PAYMENT -->
    <div>
        <p class="text-gray-500 mb-1 flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4"></i>
            Payment
        </p>
        <span class="px-3 py-1 rounded-full text-xs font-medium text-white flex items-center gap-1 w-fit
            {{ $pesanan->payment_status == 'paid' ? 'bg-green-600' : 'bg-red-500' }}">
            {{ ucfirst($pesanan->payment_status) }}
        </span>
    </div>

</div>
    </div>

    <!-- TOTAL -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

        <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i data-lucide="wallet"></i>
            Ringkasan
        </h2>

        <div class="space-y-2 text-sm">

            <div class="flex justify-between">
                <span class="text-gray-500">Total Harga</span>
                <span>Rp {{ number_format($pesanan->total_harga) }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Ongkir</span>
                <span>Rp {{ number_format($pesanan->ongkir) }}</span>
            </div>

            <hr>

            <div class="flex justify-between font-semibold text-gray-900">
                <span>Total Bayar</span>
                <span>Rp {{ number_format($pesanan->total_bayar) }}</span>
            </div>

        </div>

    </div>

</div>

<!-- ALAMAT -->
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-6">

    <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
        <i data-lucide="map-pin"></i>
        Alamat Pengiriman
    </h2>

    <div class="text-sm space-y-1">
        <p class="font-medium">{{ $pesanan->alamat->nama_penerima }}</p>
        <p>{{ $pesanan->alamat->no_telepon }}</p>
        <p class="text-gray-500">{{ $pesanan->alamat->alamat_lengkap }}</p>
    </div>

</div>

<!-- PRODUK -->
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-6">

    <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
        <i data-lucide="package"></i>
        Daftar Produk
    </h2>

    <div class="space-y-4">

        @foreach($pesanan->details as $d)
        <div class="flex items-center justify-between border rounded-xl p-3">

            <div class="flex items-center gap-3">
                <img src="{{ asset('storage/'.$d->produk->gambar_1) }}"
                     class="w-14 h-14 object-cover rounded-lg">

                <div>
                    <p class="font-medium text-gray-800">
                        {{ $d->produk->nama_produk }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $d->qty }} x Rp {{ number_format($d->harga) }}
                    </p>
                </div>
            </div>

            <p class="font-semibold text-gray-900">
                Rp {{ number_format($d->harga * $d->qty) }}
            </p>

        </div>
        @endforeach

    </div>

</div>

<!-- STATUS UPDATE -->
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

@php
$statusOrder = [
    'tertunda' => 1,
    'diproses' => 2,
    'dikirim' => 3,
    'selesai' => 4,
    'gagal' => 5
];

$current = $statusOrder[$pesanan->order_status] ?? 1;
@endphp

@if($pesanan->order_status === 'selesai')

    <p class="text-green-600 font-semibold flex items-center gap-2">
        <i data-lucide="check-circle"></i>
        Pesanan sudah selesai
    </p>

@elseif($pesanan->order_status === 'gagal')

    <p class="text-red-600 font-semibold flex items-center gap-2">
        <i data-lucide="x-circle"></i>
        Pesanan dibatalkan / gagal
    </p>

@elseif($pesanan->payment_status !== 'paid')

    <p class="text-red-600 font-semibold flex items-center gap-2">
        <i data-lucide="alert-circle"></i>
        Tidak bisa update status (belum dibayar)
    </p>

@else

<form method="POST"
      action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}">

    @csrf
    @method('PATCH')

    <div class="flex items-center gap-4">

<div class="relative w-56">

    <!-- Icon -->
    <i data-lucide="refresh-cw"
       class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>

    <!-- Select -->
    <select name="order_status"
        class="appearance-none w-full pl-9 pr-10 py-2 rounded-xl border border-gray-300 text-sm text-gray-700 bg-white
               focus:ring-2 focus:ring-[#AA1B25] focus:border-[#AA1B25] focus:outline-none
               hover:border-gray-400 transition cursor-pointer">

        @foreach($statusOrder as $status => $value)
            @if($status === 'gagal') @continue @endif

            <option value="{{ $status }}"
                {{ $value < $current ? 'disabled' : '' }}
                {{ $pesanan->order_status == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach

    </select>

    <!-- Arrow -->
    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>

</div>

        <button class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm hover:bg-slate-800 transition flex items-center gap-2">
            <i data-lucide="refresh-cw"></i>
            Update Status
        </button>

    </div>

</form>

@endif

</div>

@endsection
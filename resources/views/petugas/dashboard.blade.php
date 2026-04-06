@extends('petugas.layout')

@section('content')



    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Petugas</h1>
        <p class="text-sm text-gray-500">Ringkasan aktivitas dan status pesanan</p>
    </div>

    {{-- 🔥 CARD --}}
    <div class="grid grid-cols-2 gap-6 mb-8">

        <!-- DIPROSES -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Sedang diproses</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $diproses }}</h2>
            </div>
            <div class="bg-blue-100 text-blue-700 p-3 rounded-xl">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- DIKIRIM -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Sedang dikirim</p>
                <h2 class="text-3xl font-bold text-gray-800 mt-1">{{ $dikirim }}</h2>
            </div>
            <div class="bg-blue-100 text-blue-700 p-3 rounded-xl">
                <i data-lucide="truck" class="w-6 h-6"></i>
            </div>
        </div>

    </div>

    {{-- 🔥 LOG --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            Aktivitas Terbaru
        </h2>

        <ul class="space-y-4">

            @forelse($logs as $log)

                <li class="flex items-start gap-3 border-b pb-3 text-sm text-gray-700">

                    <!-- ICON -->
                    <div class="mt-0.5">
                        @if($log->order_status == 'diproses')
                            <i data-lucide="package" class="w-4 h-4 text-blue-600"></i>

                        @elseif($log->order_status == 'dikirim')
                            <i data-lucide="truck" class="w-4 h-4 text-blue-600"></i>

                        @elseif($log->order_status == 'selesai')
                            <i data-lucide="check-circle" class="w-4 h-4 text-green-600"></i>
                        @endif
                    </div>

                    <!-- TEXT -->
                    <div>
                        @if($log->order_status == 'diproses')
                            Pesanan <b>{{ $log->kode }}</b> masuk dan siap diproses

                        @elseif($log->order_status == 'dikirim')
                            Pesanan <b>{{ $log->kode }}</b> sedang dalam pengiriman

                        @elseif($log->order_status == 'selesai')
                            Pesanan <b>{{ $log->kode }}</b> telah selesai
                        @endif
                    </div>

                </li>

            @empty

                <li class="text-gray-500 text-sm flex items-center gap-2">
                    <i data-lucide="info" class="w-4 h-4"></i>
                    Belum ada aktivitas
                </li>

            @endforelse

        </ul>

    </div>



@endsection
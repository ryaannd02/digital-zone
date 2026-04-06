@extends('admin.layout')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="bar-chart-3"></i>
            Laporan
        </h1>
        <p class="text-sm text-gray-500 mt-1">Analisis penjualan dan performa toko</p>
    </div>

    <!-- PDF -->
    <a href="{{ route('admin.laporan.pdf', ['from'=>request('from'),'to'=>request('to')]) }}"
       class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm hover:bg-slate-800 transition">
        <i data-lucide="download"></i>
        Download PDF
    </a>
</div>

<!-- FILTER -->
<div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm flex flex-wrap justify-between items-center gap-3">

    <form method="GET" class="flex flex-wrap items-end gap-3">

        <div>
            <label class="text-xs text-gray-500">Dari</label>
            <input type="date" name="from"
                   value="{{ $from }}"
                   class="block border border-gray-300 px-3 py-2 rounded-xl text-sm focus:ring-2 focus:ring-slate-400">
        </div>

        <div>
            <label class="text-xs text-gray-500">Sampai</label>
            <input type="date" name="to"
                   value="{{ $to }}"
                   class="block border border-gray-300 px-3 py-2 rounded-xl text-sm focus:ring-2 focus:ring-slate-400">
        </div>

        <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2 hover:bg-slate-900 transition">
            <i data-lucide="filter"></i>
            Tampilkan
        </button>

    </form>

</div>

<!-- STATS -->
<div class="grid md:grid-cols-3 gap-6 mb-6">

    <div class="bg-white border border-gray-200 p-5 rounded-2xl shadow-sm">
        <p class="text-gray-500 text-sm flex items-center gap-2">
            <i data-lucide="wallet" class="w-4 h-4"></i>
            Total Pendapatan
        </p>
        <p class="text-2xl font-semibold text-gray-900 mt-2">
            Rp {{ number_format($totalPendapatan) }}
        </p>
    </div>

    <div class="bg-white border border-gray-200 p-5 rounded-2xl shadow-sm">
        <p class="text-gray-500 text-sm flex items-center gap-2">
            <i data-lucide="shopping-cart" class="w-4 h-4"></i>
            Total Pesanan
        </p>
        <p class="text-2xl font-semibold text-gray-900 mt-2">
            {{ $totalPesanan }}
        </p>
    </div>

    <div class="bg-white border border-gray-200 p-5 rounded-2xl shadow-sm">
        <p class="text-gray-500 text-sm flex items-center gap-2">
            <i data-lucide="package" class="w-4 h-4"></i>
            Produk Terjual
        </p>
        <p class="text-2xl font-semibold text-gray-900 mt-2">
            {{ $totalProduk }}
        </p>
    </div>

</div>

<!-- GRID -->
<div class="grid lg:grid-cols-3 gap-6 mb-6">

    <!-- CHART -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i data-lucide="line-chart"></i>
            Grafik Pendapatan
        </h2>
        <canvas id="chart"></canvas>
    </div>

    <!-- TOP PRODUK -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
            <i data-lucide="star"></i>
            Produk Terlaris
        </h2>

        <div class="space-y-3">
            @foreach($topProduk as $p)
<div class="flex items-start justify-between gap-3 border-b pb-3">

    <!-- KIRI -->
    <div class="flex items-start gap-3">

        <!-- ICON -->
        <div class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg flex-shrink-0">
            <i data-lucide="package" class="w-4 h-4 text-gray-500"></i>
        </div>

        <!-- TEXT -->
        <p class="text-sm text-gray-800 leading-snug">
            {{ $p->nama_produk }}
        </p>

    </div>

    <!-- JUMLAH -->
    <span class="text-xs font-semibold bg-gray-100 px-2 py-1 rounded whitespace-nowrap">
        {{ $p->total }}x
    </span>

</div>
            @endforeach
        </div>
    </div>

</div>

<!-- INFO -->
<div class="mb-4 text-sm text-gray-500 flex items-center gap-2">
    <i data-lucide="database" class="w-4 h-4"></i>
    Total Data: {{ $pesanans->count() }}
</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
            <tr>

                <th class="p-4 text-left">
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar"></i>
                        Tanggal
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="hash"></i>
                        Kode
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="user"></i>
                        Customer
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="activity"></i>
                        Status
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="banknote"></i>
                        Total
                    </div>
                </th>

            </tr>
        </thead>

        <tbody>
            @forelse($pesanans as $p)
            <tr class="border-t hover:bg-gray-50 transition align-middle">

                <td class="p-4">
                    {{ $p->created_at->format('d M Y') }}
                </td>

                <td class="font-medium text-gray-800">
                    #{{ $p->kode }}
                </td>

                <td class="text-gray-700">
                    {{ $p->user->name ?? '-' }}
                </td>

                <td>
                    <span class="px-3 py-1 rounded-full text-xs font-medium text-white
                        @if($p->order_status == 'tertunda') bg-gray-500
                        @elseif($p->order_status == 'diproses') bg-slate-700
                        @elseif($p->order_status == 'dikirim') bg-amber-500
                        @else bg-green-600
                        @endif">
                        {{ ucfirst($p->order_status) }}
                    </span>
                </td>

                <td class="font-semibold text-gray-900">
                    Rp {{ number_format($p->total_bayar) }}
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-8 text-gray-500">
                    Tidak ada data
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const data = @json($chart);

new Chart(document.getElementById('chart'), {
    type: 'line',
    data: {
        labels: data.map(d => d.tanggal),
        datasets: [{
            label: 'Pendapatan',
            data: data.map(d => d.total),
            borderWidth: 2,
            tension: 0.4
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

@endsection
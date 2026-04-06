@extends('admin.layout')

@section('content')

<div>
    <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
        <i data-lucide="layout-dashboard"></i>
        Dashboard Admin
    </h1>
    <p class="text-sm text-gray-500 mt-1">
        Ringkasan aktivitas dan performa toko hari ini
    </p>
</div>

<br>

<!-- Stats -->
<div class="grid md:grid-cols-3 gap-6 mb-10">

    <!-- Produk -->
    <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Produk</p>
                <h2 class="text-3xl font-bold mt-1 text-gray-900">{{ $totalProduk }}</h2>
            </div>
            <div class="bg-slate-100 p-3 rounded-xl">
                <i data-lucide="box" class="w-6 h-6 text-slate-700"></i>
            </div>
        </div>
    </div>

    <!-- Pesanan -->
    <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pesanan</p>
                <h2 class="text-3xl font-bold mt-1 text-gray-900">{{ $totalPesanan }}</h2>
            </div>
            <div class="bg-slate-100 p-3 rounded-xl">
                <i data-lucide="shopping-cart" class="w-6 h-6 text-slate-700"></i>
            </div>
        </div>
    </div>

    <!-- Pendapatan -->
    <div class="bg-white border border-gray-200 p-6 rounded-2xl shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pendapatan</p>
                <h2 class="text-2xl font-bold mt-1 text-gray-900">
                    Rp {{ number_format($totalPendapatan) }}
                </h2>
            </div>
            <div class="bg-slate-100 p-3 rounded-xl">
                <i data-lucide="wallet" class="w-6 h-6 text-slate-700"></i>
            </div>
        </div>
    </div>

</div>

<!-- Grid Content -->
<div class="grid lg:grid-cols-3 gap-6">

    <!-- Table -->
    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Pesanan Terbaru</h2>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-400 text-xs uppercase">
                        <th class="text-left py-2">Kode</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pesananTerbaru as $p)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 font-semibold text-gray-800">#{{ $p->kode }}</td>
                        <td>
                            <span class="px-3 py-1 rounded-full text-xs bg-gray-100 text-gray-700">
                                {{ $p->order_status }}
                            </span>
                        </td>
                        <td class="font-medium text-gray-700">
                            Rp {{ number_format($p->total_bayar) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Grafik Penjualan</h2>
        <canvas id="salesChart"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const chartData = @json($chart);

const labels = Object.keys(chartData);
const data = Object.values(chartData);

new Chart(document.getElementById('salesChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pendapatan',
            data: data,
            borderWidth: 2,
            tension: 0.4,
            fill: true,
            backgroundColor: 'rgba(100, 116, 139, 0.1)', // slate soft
            borderColor: '#334155', // slate-700
            pointBackgroundColor: '#334155'
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

@endsection
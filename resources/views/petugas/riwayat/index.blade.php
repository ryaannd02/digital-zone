@extends('petugas.layout')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h1>
    <p class="text-sm text-gray-500">Daftar pesanan yang telah selesai</p>
</div>

<!-- FILTER -->
<form method="GET"
      class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-4 items-end">

    <!-- DARI -->
    <div>
        <label class="text-xs text-gray-500">Dari Tanggal</label>
        <div class="relative">
            <input type="date"
                   name="dari"
                   value="{{ request('dari') }}"
                   class="border px-3 py-2 pl-9 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none">

            <i data-lucide="calendar" class="w-4 h-4 absolute left-2 top-2.5 text-gray-400"></i>
        </div>
    </div>

    <!-- SAMPAI -->
    <div>
        <label class="text-xs text-gray-500">Sampai</label>
        <div class="relative">
            <input type="date"
                   name="sampai"
                   value="{{ request('sampai') }}"
                   class="border px-3 py-2 pl-9 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none">

            <i data-lucide="calendar-days" class="w-4 h-4 absolute left-2 top-2.5 text-gray-400"></i>
        </div>
    </div>

    <!-- FILTER BUTTON -->
    <button
        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center gap-2">
        <i data-lucide="filter" class="w-4 h-4"></i>
        Filter
    </button>

    <!-- RESET -->
    <a href="{{ route('petugas.riwayat.index') }}"
       class="px-4 py-2 rounded-lg text-sm border border-gray-200 text-gray-600 hover:bg-gray-50 transition flex items-center gap-2">
        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
        Reset
    </a>

</form>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
            <tr>
                <th class="p-4 text-left">Kode</th>
                <th class="text-left">Customer</th>
                <th class="text-left">Status</th>
                <th class="text-left">Total</th>
                <th class="text-left">Tanggal</th>
            </tr>
        </thead>

        <tbody class="divide-y">

            @forelse($pesanans as $p)
            <tr class="hover:bg-gray-50 transition">

                <!-- ID -->
                <td class="p-4 font-medium text-gray-800">
                    #{{ $p->kode }}
                </td>

                <!-- CUSTOMER -->
                <td class="text-gray-700">
                    {{ $p->user->name }}
                </td>

                <!-- STATUS -->
                <td>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                        <i data-lucide="check-circle" class="w-3 h-3"></i>
                        {{ $p->order_status }}
                    </span>
                </td>

                <!-- TOTAL -->
                <td class="font-medium text-gray-800">
                    Rp {{ number_format($p->total_bayar) }}
                </td>

                <!-- TANGGAL -->
                <td class="text-gray-600 flex items-center gap-1">
                    <i data-lucide="calendar" class="w-3 h-3"></i>
                    {{ $p->created_at->format('d M Y') }}
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="5" class="p-8 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <i data-lucide="inbox" class="w-6 h-6"></i>
                        Belum ada riwayat
                    </div>
                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $pesanans->links() }}
</div>

@endsection
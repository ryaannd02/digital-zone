@extends('petugas.layout')

@section('content')

<!-- HEADER -->
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Pesanan</h1>
    <p class="text-sm text-gray-500">Kelola dan pantau semua pesanan</p>
</div>

<!-- FILTER -->
<form method="GET"
      class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-3 items-center">

    <!-- STATUS -->
    <div class="flex items-center gap-2">
        <i data-lucide="filter" class="w-4 h-4 text-gray-400"></i>

        <select name="status"
                onchange="this.form.submit()"
                class="border px-3 py-2 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none">

            <option value="semua">Semua</option>
            <option value="diproses" {{ request('status')=='diproses'?'selected':'' }}>
                Diproses
            </option>
            <option value="dikirim" {{ request('status')=='dikirim'?'selected':'' }}>
                Dikirim
            </option>

        </select>
    </div>

    <!-- SEARCH -->
    <div class="relative flex-1 min-w-[200px]">
        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Cari kode pesanan..."
               class="w-full border px-4 py-2 pl-10 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 outline-none">

        <i data-lucide="search" class="w-4 h-4 absolute left-3 top-2.5 text-gray-400"></i>
    </div>

    <!-- BUTTON -->
    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition flex items-center gap-2">
        <i data-lucide="search" class="w-4 h-4"></i>
        Cari
    </button>

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
                <th class="text-left">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">

            @forelse($pesanans as $p)
            <tr class="hover:bg-gray-50 transition">

                <!-- KODE -->
                <td class="p-4 font-semibold text-gray-800">
                    #{{ $p->kode }}
                </td>

                <!-- CUSTOMER -->
                <td class="text-gray-700">
                    {{ $p->user->name }}
                </td>

                <!-- STATUS -->
                <td>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                        @if($p->order_status == 'diproses') bg-yellow-100 text-yellow-700
                        @elseif($p->order_status == 'dikirim') bg-blue-100 text-blue-700
                        @elseif($p->order_status == 'selesai') bg-green-100 text-green-700
                        @endif">

                        @if($p->order_status == 'diproses')
                            <i data-lucide="package" class="w-3 h-3"></i>
                        @elseif($p->order_status == 'dikirim')
                            <i data-lucide="truck" class="w-3 h-3"></i>
                        @elseif($p->order_status == 'selesai')
                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                        @endif

                        {{ $p->order_status }}
                    </span>
                </td>

                <!-- TOTAL -->
                <td class="font-medium text-gray-800">
                    Rp {{ number_format($p->total_bayar) }}
                </td>

                <!-- AKSI -->
                <td>
                    <a href="{{ route('petugas.pesanan.show', $p->id) }}"
                       class="inline-flex items-center gap-1 bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-blue-700 transition">

                        <i data-lucide="eye" class="w-3 h-3"></i>
                        Detail
                    </a>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="5" class="text-center p-8 text-gray-500">
                    <div class="flex flex-col items-center gap-2">
                        <i data-lucide="inbox" class="w-6 h-6"></i>
                        Tidak ada pesanan
                    </div>
                </td>
            </tr>
            @endforelse

        </tbody>

    </table>

</div>

<!-- PAGINATION -->
@if(method_exists($pesanans, 'links'))
<div class="mt-6">
    {{ $pesanans->links() }}
</div>
@endif

@endsection
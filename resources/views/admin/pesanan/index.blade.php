@extends('admin.layout')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="shopping-cart"></i>
            Pesanan
        </h1>
        <p class="text-sm text-gray-500 mt-1">Kelola semua transaksi pesanan</p>
    </div>
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

<!-- FILTER -->
<div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm flex justify-between items-center">

    <form method="GET" class="flex gap-3 items-center">

        <div class="relative w-56">
            
            <!-- Icon -->
            <i data-lucide="filter"
            class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>

            <!-- Select -->
            <select name="status"
                class="appearance-none w-full pl-9 pr-10 py-2 rounded-xl border border-gray-300 text-sm text-gray-700 bg-white
                    focus:ring-2 focus:ring-[#AA1B25] focus:border-[#AA1B25] focus:outline-none
                    hover:border-gray-400 transition cursor-pointer">
                
                <option value="">Semua Status</option>
                <option value="tertunda">Tertunda</option>
                <option value="diproses">Diproses</option>
                <option value="dikirim">Dikirim</option>
                <option value="selesai">Selesai</option>
            </select>

            <!-- Arrow custom -->
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

        </div>

        <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2 hover:bg-slate-900 transition">
            <i data-lucide="search"></i>
            Filter
        </button>

    </form>

</div>

<!-- TABLE -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    <table class="w-full text-sm">

<thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
    <tr class="align-middle">

        <th class="p-4 text-left">
            <div class="flex items-center gap-2">
                <i data-lucide="receipt" class="w-4 h-4"></i>
                Pesanan
            </div>
        </th>

        <th>
            <div class="flex items-center gap-2">
                <i data-lucide="user" class="w-4 h-4"></i>
                User
            </div>
        </th>

        <th>
            <div class="flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4"></i>
                Tanggal
            </div>
        </th>

        <th>
            <div class="flex items-center gap-2">
                <i data-lucide="activity" class="w-4 h-4"></i>
                Status
            </div>
        </th>

        <th>
            <div class="flex items-center gap-2">
                <i data-lucide="credit-card" class="w-4 h-4"></i>
                Payment
            </div>
        </th>

        <th>
            <div class="flex items-center gap-2">
                <i data-lucide="banknote" class="w-4 h-4"></i>
                Total
            </div>
        </th>

        <th>
            <div class="flex items-center gap-2">
                <i data-lucide="settings" class="w-4 h-4"></i>
                Aksi
            </div>
        </th>

    </tr>
</thead>

        <tbody>
            @foreach($pesanans as $p)
            <tr class="border-t hover:bg-gray-50 transition align-middle">

                <!-- PESANAN -->
                <td class="p-4 align-middle">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="receipt" class="w-4 h-4 text-gray-500"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">#{{ $p->kode }}</p>
                            <p class="text-xs text-gray-400">
                                {{ $p->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </td>

                <!-- USER -->
                <td class="align-middle">
                    <div class="flex items-center gap-2 text-gray-700">
                        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                        {{ $p->user->name }}
                    </div>
                </td>

                <!-- TANGGAL -->
                <td class="align-middle">
                    <div class="flex items-center gap-2 text-gray-600">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                        {{ $p->created_at->format('d M Y') }}
                    </div>
                </td>

                <!-- STATUS -->
                <td class="align-middle">
                    <div class="flex items-center">
                        <span class="px-3 py-1 rounded-full text-xs font-medium text-white flex items-center gap-1
                            @if($p->order_status == 'tertunda') bg-gray-500
                            @elseif($p->order_status == 'diproses') bg-slate-700
                            @elseif($p->order_status == 'dikirim') bg-amber-500
                            @else bg-green-600
                            @endif">
                            <i data-lucide="activity" class="w-3 h-3"></i>
                            {{ ucfirst($p->order_status) }}
                        </span>
                    </div>
                </td>

                <!-- PAYMENT -->
                <td class="align-middle">
                    <div class="flex items-center">
                        <span class="px-3 py-1 rounded-full text-xs font-medium text-white flex items-center gap-1
                            {{ $p->payment_status == 'paid' ? 'bg-green-600' : 'bg-red-500' }}">
                            <i data-lucide="{{ $p->payment_status == 'paid' ? 'check-circle' : 'x-circle' }}" class="w-3 h-3"></i>
                            {{ ucfirst($p->payment_status) }}
                        </span>
                    </div>
                </td>

                <!-- TOTAL -->
                <td class="align-middle">
                    <div class="flex items-center gap-2 font-semibold text-gray-900">
                        <i data-lucide="banknote" class="w-4 h-4 text-gray-400"></i>
                        Rp {{ number_format($p->total_bayar) }}
                    </div>
                </td>

                <!-- AKSI -->
                <td class="align-middle">
                    <div class="flex items-center">
                        <a href="{{ route('admin.pesanan.show', $p->id) }}"
                           class="flex items-center gap-1 px-3 py-1.5 bg-slate-900 text-white rounded-lg text-xs hover:bg-slate-800 transition">
                            <i data-lucide="eye" class="w-3 h-3"></i>
                            Detail
                        </a>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $pesanans->links() }}
</div>

@endsection
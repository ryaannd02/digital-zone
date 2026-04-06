@extends('admin.layout')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="users"></i>
            Users
        </h1>
        <p class="text-sm text-gray-500 mt-1">Kelola semua pengguna sistem</p>
    </div>
</div>

<!-- SEARCH / FILTER -->
<div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm flex justify-between items-center">

    <form method="GET" class="flex items-center gap-3">

        <div class="relative">
            <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"></i>
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari user..."
                   class="pl-9 pr-3 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400 outline-none">
        </div>

        <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2 hover:bg-slate-900 transition">
            <i data-lucide="search"></i>
            Cari
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
                        <i data-lucide="user"></i>
                        Nama
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="mail"></i>
                        Email
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield"></i>
                        Role
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="shopping-cart"></i>
                        Pesanan
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="calendar"></i>
                        Terdaftar
                    </div>
                </th>

            </tr>
        </thead>

        <tbody>
            @foreach($users as $u)
            <tr class="border-t hover:bg-gray-50 transition align-middle">

                <!-- NAMA -->
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="user" class="w-4 h-4 text-gray-500"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $u->name }}</p>
                            <p class="text-xs text-gray-400">ID: {{ $u->id }}</p>
                        </div>
                    </div>
                </td>

                <!-- EMAIL -->
                <td>
                    <div class="flex items-center gap-2 text-gray-700">
                        <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                        {{ $u->email }}
                    </div>
                </td>

                <!-- ROLE -->
                <td>
                    <div class="flex items-center">
                        <span class="px-3 py-1 rounded-full text-xs font-medium text-white flex items-center gap-1
                            @if($u->role == 'admin') bg-red-600
                            @elseif($u->role == 'petugas') bg-slate-700
                            @else bg-gray-500
                            @endif">
                            <i data-lucide="shield" class="w-3 h-3"></i>
                            {{ ucfirst($u->role) }}
                        </span>
                    </div>
                </td>

                <!-- JUMLAH PESANAN -->
                <td>
                    <div class="flex items-center gap-2 text-gray-800 font-medium">
                        <i data-lucide="package" class="w-4 h-4 text-gray-400"></i>
                        {{ $u->pesanans_count }}
                    </div>
                </td>

                <!-- TANGGAL -->
                <td>
                    <div class="flex items-center gap-2 text-gray-600">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                        {{ $u->created_at->format('d M Y') }}
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $users->links() }}
</div>

@endsection     
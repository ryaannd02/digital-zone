@extends('admin.layout')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="user-cog"></i>
            Petugas
        </h1>
        <p class="text-sm text-gray-500 mt-1">Kelola akun petugas sistem</p>
    </div>

    <!-- TAMBAH -->
    <a href="{{ route('admin.petugas.create') }}"
       class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm hover:bg-slate-800 transition">
        <i data-lucide="plus"></i>
        Tambah Petugas
    </a>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-6 rounded-xl">
    {{ session('success') }}
</div>
@endif

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
                        <i data-lucide="calendar"></i>
                        Terdaftar
                    </div>
                </th>

                <th>
                    <div class="flex items-center gap-2">
                        <i data-lucide="settings"></i>
                        Aksi
                    </div>
                </th>

            </tr>
        </thead>

        <tbody>
            @foreach($petugas as $p)
            <tr class="border-t hover:bg-gray-50 transition align-middle">

                <!-- NAMA -->
                <td class="p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="user" class="w-4 h-4 text-gray-500"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $p->name }}</p>
                            <p class="text-xs text-gray-400">ID: {{ $p->id }}</p>
                        </div>
                    </div>
                </td>

                <!-- EMAIL -->
                <td>
                    <div class="flex items-center gap-2 text-gray-700">
                        <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                        {{ $p->email }}
                    </div>
                </td>

                <!-- TANGGAL -->
                <td>
                    <div class="flex items-center gap-2 text-gray-600">
                        <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                        {{ $p->created_at->format('d M Y') }}
                    </div>
                </td>

                <!-- AKSI -->
                <td class="align-middle">
                    <div class="flex items-center gap-2">

                        <a href="{{ route('admin.petugas.edit',$p->id) }}"
                           class="flex items-center gap-1 px-3 py-1.5 bg-amber-500 text-white rounded-lg text-xs hover:bg-amber-600 transition">
                            <i data-lucide="pencil" class="w-3 h-3"></i>
                            Edit
                        </a>

                        <form action="{{ route('admin.petugas.destroy',$p->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded-lg text-xs hover:bg-red-700 transition">
                                <i data-lucide="trash" class="w-3 h-3"></i>
                                Hapus
                            </button>
                        </form>

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $petugas->links() }}
</div>

@endsection
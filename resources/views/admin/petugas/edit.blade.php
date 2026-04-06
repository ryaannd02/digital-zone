@extends('admin.layout')

@section('content')

<!-- HEADER -->
<h1 class="text-3xl font-semibold mb-8 text-gray-800 flex items-center gap-2">
    <i data-lucide="user-cog"></i>
    Edit Petugas
</h1>

<form method="POST" action="{{ route('admin.petugas.update',$petugas->id) }}">
@csrf
@method('PUT')

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-6">

    <!-- NAMA -->
    <div>
        <label class="text-sm text-gray-600 mb-1 block">Nama</label>
        <div class="relative">
            <i data-lucide="user" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
            <input name="name"
                   value="{{ $petugas->name }}"
                   class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                   required>
        </div>
    </div>

    <!-- EMAIL -->
    <div>
        <label class="text-sm text-gray-600 mb-1 block">Email</label>
        <div class="relative">
            <i data-lucide="mail" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
            <input name="email"
                   value="{{ $petugas->email }}"
                   class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400"
                   required>
        </div>
    </div>

    <!-- PASSWORD -->
    <div>
        <label class="text-sm text-gray-600 mb-1 block">Password Baru (Opsional)</label>
        <div class="relative">
            <i data-lucide="lock" class="absolute left-3 top-3 w-4 h-4 text-gray-400"></i>
            <input type="password" name="password"
                   placeholder="Kosongkan jika tidak ingin mengubah"
                   class="w-full pl-9 pr-3 py-2.5 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400">
        </div>
    </div>

    <!-- BUTTON -->
    <div class="flex justify-end gap-3 pt-4 border-t">

        <a href="{{ route('admin.petugas.index') }}"
           class="px-5 py-2.5 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition flex items-center gap-2">
            <i data-lucide="arrow-left"></i>
            Batal
        </a>

        <button class="px-6 py-2.5 bg-slate-900 text-white rounded-xl hover:bg-slate-800 transition flex items-center gap-2">
            <i data-lucide="save"></i>
            Update
        </button>

    </div>

</div>

</form>

@endsection
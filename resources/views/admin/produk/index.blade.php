@extends('admin.layout')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-semibold text-gray-800 flex items-center gap-2">
            <i data-lucide="box"></i>
            Produk
        </h1>
        <p class="text-sm text-gray-500 mt-1">Kelola semua produk yang tersedia</p>
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

<!-- FILTER CARD -->
<div class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 shadow-sm flex flex-wrap justify-between items-center gap-3">

    <!-- KIRI (FILTER) -->
    <form method="GET" class="flex flex-wrap gap-3 items-center">

        <div class="relative">
            <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"></i>
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari produk..."
                   class="pl-9 pr-3 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-slate-400 outline-none">
        </div>

        <div class="relative w-64">
            <select name="kategori_id"
                class="appearance-none w-full bg-white border border-gray-300 px-4 py-2 pr-10 rounded-xl text-sm text-gray-700 shadow-sm
                    focus:ring-2 focus:ring-[#AA1B25] focus:border-[#AA1B25] focus:outline-none
                    hover:border-gray-400 transition">
                
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}"
                        {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <!-- Custom arrow -->
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        <button class="bg-slate-800 text-white px-4 py-2 rounded-xl text-sm flex items-center gap-2 hover:bg-slate-900 transition">
            <i data-lucide="filter"></i>
            Filter
        </button>

    </form>

    <!-- KANAN (TOMBOL) -->
    <a href="{{ route('admin.produk.create') }}"
       class="flex items-center gap-2 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm hover:bg-slate-800 transition">
        <i data-lucide="plus"></i>
        Tambah Produk
    </a>

</div>

<!-- TABLE CARD -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
            <tr>
                <th class="p-4 text-center align-middle">
                    <input type="checkbox" id="checkAll">
                </th>
                <th class="text-left">Produk</th>
                <th class="text-left">Harga</th>
                <th class="text-left">Stok</th>
                <th class="text-left">Status</th>
                <th class="text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($produks as $p)
            <tr class="border-t hover:bg-gray-50 transition">

                <!-- Checkbox -->
                <td class="p-4 text-center align-middle">
                    <input type="checkbox"
                        name="ids[]"
                        value="{{ $p->id }}"
                        class="itemCheckbox"
                        form="bulkForm">
                </td>

                <!-- PRODUK (UPGRADE) -->
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i data-lucide="package" class="w-4 h-4 text-gray-500"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $p->nama_produk }}</p>
                            <p class="text-xs text-gray-400">ID: #{{ $p->id }}</p>
                        </div>
                    </div>
                </td>

                <!-- Harga -->
                <td class="text-gray-700 font-medium">
                    Rp {{ number_format($p->harga) }}
                </td>

                <!-- Stok -->
                <td>
                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                        {{ $p->stok }}
                    </span>
                </td>

                <!-- Status -->
                <td>
                    <form action="{{ route('admin.produk.toggle', $p->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                            class="px-3 py-1 rounded-full text-xs font-medium text-white flex items-center gap-1
                            {{ $p->is_active ? 'bg-green-600' : 'bg-gray-500' }}">
                            <i data-lucide="{{ $p->is_active ? 'check-circle' : 'x-circle' }}" class="w-3 h-3"></i>
                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                </td>

                <!-- Aksi -->
                <td class="align-middle">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.produk.edit',$p->id) }}"
                        class="flex items-center gap-1 px-3 py-1.5 bg-amber-500 text-white rounded-lg text-xs hover:bg-amber-600 transition">
                            <i data-lucide="pencil" class="w-3 h-3"></i>
                            Edit
                        </a>

                        <button type="button"
                                onclick="openModal('{{ route('admin.produk.destroy', $p->id) }}')"
                                class="flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded-lg text-xs hover:bg-red-700 transition">
                            <i data-lucide="trash" class="w-3 h-3"></i>
                            Hapus
                        </button>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<!-- BULK -->
<form id="bulkForm" method="POST" action="{{ route('admin.produk.bulkDelete') }}"
      onsubmit="return confirmBulkDelete()">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="mt-4 bg-red-700 text-white px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 hover:bg-red-800 transition">
        <i data-lucide="trash-2"></i>
        Hapus Terpilih
    </button>
</form>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $produks->links() }}
</div>

<div id="deleteModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl w-80 text-center shadow-lg">
        <p class="text-gray-700 mb-4 font-medium">Yakin ingin menghapus produk?</p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-200 rounded-lg">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('checkAll').addEventListener('click', function() {
    document.querySelectorAll('.itemCheckbox').forEach(cb => {
        cb.checked = this.checked;
    });
});

function openModal(url) {
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteForm').action = url;
}

function closeModal() {
    document.getElementById('deleteModal').classList.add('hidden');
}

function confirmBulkDelete() {
    const checked = document.querySelectorAll('.itemCheckbox:checked');

    if (checked.length === 0) {
        alert('Pilih minimal 1 produk!');
        return false;
    }

    return confirm('Yakin ingin menghapus produk terpilih?');
}
</script>

@endsection
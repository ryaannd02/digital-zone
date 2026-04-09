@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">

        <div>
            <div class="flex items-center gap-3">

                <!-- BACK -->
                <a href="#"
                   onclick="event.preventDefault(); 
                        const ref = document.referrer;
                        if (ref && !ref.includes('/create') && !ref.includes('/edit')) {
                            history.back();
                        } else {
                            window.location.href='{{ route('dashboard') }}';
                        }"
                   class="p-2 rounded-xl bg-gray-100 hover:bg-red-50 text-gray-600 hover:text-red-600 transition">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>

                <h2 class="text-2xl font-bold text-gray-800">
                    Akun & Alamat
                </h2>
            </div>

            <p class="text-gray-500 text-sm mt-2 ml-10">
                Kelola akun dan alamat pengiriman Anda
            </p>
        </div>

        @if($alamats->count() < 3)
            <a href="{{ route('alamat.create') }}"
               class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl shadow-sm transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Tambah Alamat
            </a>
        @else
            <button disabled
                    class="bg-gray-200 text-gray-500 px-5 py-2.5 rounded-xl cursor-not-allowed">
                Maksimal 3 Alamat
            </button>
        @endif

    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6">
            {{ session('error') }}
        </div>
    @endif

    @php $user = auth()->user(); @endphp

    <!-- ACCOUNT CARD -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border mb-10 hover:shadow-md transition">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-4">

                <!-- AVATAR -->
                <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center font-bold text-lg">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <p class="font-semibold text-gray-800">
                        {{ $user->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $user->email }}
                    </p>

                    <p class="text-xs text-gray-400 mt-1">
                        Bergabung sejak {{ $user->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>

            <button onclick="openModal('modalAkun')"
                class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition">

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M11 5h2M12 20h9M16.862 3.487a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.862-12.513z"/>
                </svg>

                Edit
            </button>

        </div>

    </div>

    <!-- MODAL -->
    <div id="modalAkun"
         class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50"
         onclick="outsideClick(event, 'modalAkun')">

        <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl"
             onclick="event.stopPropagation()">

            <h3 class="font-semibold text-lg mb-4">Update Akun</h3>

            <form method="POST" action="{{ route('akun.update') }}">
                @csrf
                @method('PATCH')

                <input type="text" name="name"
                    value="{{ $user->name }}"
                    class="w-full border px-3 py-2 rounded-lg mb-3 focus:ring-2 focus:ring-red-500 outline-none"
                    placeholder="Nama"
                    required>

                <input type="email" name="email"
                    value="{{ $user->email }}"
                    class="w-full border px-3 py-2 rounded-lg mb-3 focus:ring-2 focus:ring-red-500 outline-none"
                    placeholder="Email"
                    required>

                <p class="text-xs text-gray-400 mb-2">
                    Kosongkan password jika tidak ingin mengubah
                </p>

                <input type="password" name="password"
                    class="w-full border px-3 py-2 rounded-lg mb-3"
                    placeholder="Password baru">

                <input type="password" name="password_confirmation"
                    class="w-full border px-3 py-2 rounded-lg mb-4"
                    placeholder="Konfirmasi password">

                <div class="flex justify-end gap-2">
                    <button type="button"
                        onclick="closeModal('modalAkun')"
                        class="px-4 py-2 text-gray-500 hover:text-gray-700">
                        Batal
                    </button>

                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- ADDRESS -->
    @forelse($alamats as $alamat)

    <div class="bg-white rounded-2xl border p-6 mb-6 hover:shadow-md transition">

        <div class="flex justify-between items-start mb-4">

            <div class="flex gap-2 flex-wrap">

                <span class="px-3 py-1 text-xs rounded-full font-medium
                    {{ $alamat->label == 'rumah' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ strtoupper($alamat->label) }}
                </span>

                @if($alamat->is_primary)
                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">
                        Utama
                    </span>
                @endif

            </div>

        </div>

        <div class="mb-5">
            <p class="font-semibold text-gray-800">
                {{ $alamat->nama_penerima }}
            </p>

            <p class="text-sm text-gray-500">
                {{ $alamat->no_telepon }}
            </p>

            <p class="text-sm text-gray-700 mt-2 leading-relaxed">
                {{ $alamat->alamat_lengkap }}
            </p>
        </div>

        <div class="flex gap-5 flex-wrap text-sm">

            @if(!$alamat->is_primary)
            <form action="{{ route('alamat.primary', $alamat->id) }}" method="POST">
                @csrf
                <button class="flex items-center gap-1 text-red-600 hover:underline">
                    ✔ Jadikan Utama
                </button>
            </form>
            @endif

            <a href="{{ route('alamat.edit', $alamat->id) }}"
               class="flex items-center gap-1 text-blue-600 hover:underline">
                Edit
            </a>

            <form action="{{ route('alamat.destroy', $alamat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="flex items-center gap-1 text-red-600 hover:underline">
                    Hapus
                </button>
            </form>

        </div>

    </div>

    @empty

    <div class="bg-white rounded-2xl border p-12 text-center">

        <div class="flex justify-center mb-4 text-gray-300">
            📍
        </div>

        <p class="text-gray-500 mb-4">
            Anda belum memiliki alamat
        </p>

        <a href="{{ route('alamat.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl">
            Tambah Alamat Pertama
        </a>

    </div>

    @endforelse

</div>

<script>
function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// klik luar modal
function outsideClick(e, id) {
    if (e.target.id === id) {
        closeModal(id);
    }
}
</script>

@endsection
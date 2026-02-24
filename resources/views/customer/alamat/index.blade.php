@extends('guest.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#F5AD1B]">
                Alamat Saya
            </h2>
            <p class="text-gray-500 text-sm">
                Kelola alamat pengiriman Anda
            </p>
        </div>

        @if($alamats->count() < 3)
            <a href="{{ route('alamat.create') }}"
               class="bg-[#AA1B25] text-white px-6 py-3 rounded-lg">
                + Tambah Alamat
            </a>
        @else
            <button disabled
                    class="bg-gray-300 text-gray-600 px-6 py-3 rounded-lg cursor-not-allowed">
                Maksimal 3 Alamat
            </button>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif


    @forelse($alamats as $alamat)

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <div class="flex justify-between items-start mb-4">

            <div class="flex gap-3 items-center">

                {{-- Badge Label --}}
                <span class="px-3 py-1 text-xs rounded-full
                    {{ $alamat->label == 'rumah' ? 'bg-[#F5AD1B] text-black' : 'bg-blue-200 text-blue-800' }}">
                    {{ strtoupper($alamat->label) }}
                </span>

                {{-- Primary --}}
                @if($alamat->is_primary)
                    <span class="px-3 py-1 text-xs rounded-full bg-[#AA1B25] text-white">
                        Alamat Utama
                    </span>
                @endif

            </div>

        </div>

        <div class="mb-4">
            <p class="font-semibold">{{ $alamat->nama_penerima }}</p>
            <p class="text-gray-600 text-sm">{{ $alamat->no_telepon }}</p>
            <p class="text-gray-700 mt-2">
                {{ $alamat->alamat_lengkap }}
            </p>
        </div>

        <div class="flex gap-4 flex-wrap">

            @if(!$alamat->is_primary)
                <form action="{{ route('alamat.primary', $alamat->id) }}" method="POST">
                    @csrf
                    <button class="text-[#AA1B25] font-semibold text-sm">
                        Jadikan Utama
                    </button>
                </form>
            @endif

            <a href="{{ route('alamat.edit', $alamat->id) }}"
               class="text-blue-600 font-semibold text-sm">
                Edit
            </a>

            <form action="{{ route('alamat.destroy', $alamat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-600 font-semibold text-sm">
                    Hapus
                </button>
            </form>

        </div>

    </div>

    @empty

    <div class="bg-white rounded-xl shadow p-10 text-center">
        <p class="text-gray-600 mb-4">
            Anda belum memiliki alamat.
        </p>

        <a href="{{ route('alamat.create') }}"
           class="bg-[#AA1B25] text-white px-6 py-3 rounded-lg">
            Tambah Alamat Pertama
        </a>
    </div>

    @endforelse

</div>

@endsection
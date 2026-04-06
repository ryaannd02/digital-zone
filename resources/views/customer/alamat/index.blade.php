@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

<div>

    <div class="flex items-center gap-3">

        <!-- BACK BUTTON -->
        <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('customer.dashboard') }}"
           class="p-1 rounded-lg text-gray-600 hover:text-red-600 hover:bg-gray-100 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-6 h-6"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
        </a>

        <!-- TITLE -->
        <h2 class="text-2xl font-bold text-gray-800">
            Alamat Saya
        </h2>

    </div>

    <!-- SUBTEXT -->
    <p class="text-gray-500 text-sm mt-2 ml-9">
        Kelola alamat pengiriman Anda
    </p>

</div>

        @if($alamats->count() < 3)
            <a href="{{ route('alamat.create') }}"
               class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl shadow transition">

                <!-- PLUS ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6">
            {{ session('error') }}
        </div>
    @endif


    @forelse($alamats as $alamat)

    <!-- CARD -->
    <div class="bg-white rounded-2xl border hover:shadow-md transition p-6 mb-5">

        <!-- TOP -->
        <div class="flex justify-between items-start mb-4">

            <div class="flex flex-wrap gap-2">

                <!-- LABEL -->
                <span class="px-3 py-1 text-xs rounded-full font-medium
                    {{ $alamat->label == 'rumah' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                    {{ strtoupper($alamat->label) }}
                </span>

                <!-- PRIMARY -->
                @if($alamat->is_primary)
                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-600 font-medium">
                        Utama
                    </span>
                @endif

            </div>

        </div>

        <!-- CONTENT -->
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

        <!-- ACTION -->
        <div class="flex items-center gap-5 flex-wrap text-sm">

            @if(!$alamat->is_primary)
                <form action="{{ route('alamat.primary', $alamat->id) }}" method="POST">
                    @csrf
                    <button class="flex items-center gap-1 text-red-600 hover:underline">

                        <!-- CHECK ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  d="M5 13l4 4L19 7"/>
                        </svg>

                        Jadikan Utama
                    </button>
                </form>
            @endif

            <a href="{{ route('alamat.edit', $alamat->id) }}"
               class="flex items-center gap-1 text-blue-600 hover:underline">

                <!-- EDIT ICON -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11 5h2M12 20h9M16.862 3.487a2.1 2.1 0 113 3L7 19l-4 1 1-4 12.862-12.513z"/>

                </svg>

                Edit
            </a>

            <form action="{{ route('alamat.destroy', $alamat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="flex items-center gap-1 text-red-600 hover:underline">

                    <!-- DELETE ICON -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>

                    Hapus
                </button>
            </form>

        </div>

    </div>

    @empty

    <!-- EMPTY -->
    <div class="bg-white rounded-2xl border p-12 text-center flex flex-col items-center gap-4">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-14 h-14 text-gray-300"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">

            <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243A8 8 0 1117.657 16.657z"/>

        </svg>

        <p class="text-gray-500">
            Anda belum memiliki alamat.
        </p>

        <a href="{{ route('alamat.create') }}"
           class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-xl">
            Tambah Alamat Pertama
        </a>

    </div>

    @endforelse

</div>

@endsection
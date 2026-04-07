@extends('customer.layout')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-4">

    <!-- HEADER -->
    <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center gap-3">

        <!-- BACK BUTTON -->
        <a href="#"
        onclick="event.preventDefault(); 
                    if (window.history.length > 1) { 
                        history.back(); 
                    } else { 
                        window.location.href='{{ route('dashboard') }}'; 
                    }"
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

        Edit Alamat

    </h2>

    <!-- FORM -->
<form action="{{ route('alamat.update', $alamat->id) }}" method="POST">
    @csrf
    @method('PUT')

        <!-- NAMA -->
        <div>
            <label class="text-sm font-medium text-gray-700 mb-1 block">
                Nama Penerima
            </label>

            <div class="relative">
                <input type="text" name="nama_penerima"
                       value="{{ $alamat->nama_penerima }}"
                       class="w-full border rounded-xl pl-10 pr-4 py-3 focus:ring-2 focus:ring-red-200 outline-none"
                       required>

                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- TELEPON -->
        <div>
            <label class="text-sm font-medium text-gray-700 mb-1 block">
                No Telepon
            </label>

            <div class="relative">
                <input type="text" name="no_telepon"
                       value="{{ $alamat->no_telepon }}"
                       class="w-full border rounded-xl pl-10 pr-4 py-3 focus:ring-2 focus:ring-red-200 outline-none"
                       required>

                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M3 5a2 2 0 012-2h2l2 5-2 2a11 11 0 005 5l2-2 5 2v2a2 2 0 01-2 2A16 16 0 013 5z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- ALAMAT -->
        <div>
            <label class="text-sm font-medium text-gray-700 mb-1 block">
                Alamat Lengkap
            </label>

            <div class="relative">
                <textarea name="alamat_lengkap"
                          rows="4"
                          class="w-full border rounded-xl pl-10 pr-4 py-3 focus:ring-2 focus:ring-red-200 outline-none"
                          required>{{ $alamat->alamat_lengkap }}</textarea>

                <div class="absolute left-3 top-4 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M9 20l-5-2V6l5 2m0 12l6-2m-6 2V8m6 10l5 2V6l-5-2m0 12V4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- LABEL -->
        <div>
            <label class="text-sm font-medium text-gray-700 mb-1 block">
                Label
            </label>

            <div class="relative">
                <select name="label"
                        class="w-full border rounded-xl pl-10 pr-4 py-3 focus:ring-2 focus:ring-red-200 outline-none"
                        required>
                    <option value="rumah" {{ $alamat->label == 'rumah' ? 'selected' : '' }}>Rumah</option>
                    <option value="kantor" {{ $alamat->label == 'kantor' ? 'selected' : '' }}>Kantor</option>
                </select>

                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                              d="M7 7h.01M7 3h5l9 9-5 5-9-9V3z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- ACTION -->
        <div class="flex justify-between items-center pt-6">

            <a href="{{ route('alamat.index') }}"
               class="text-gray-500 hover:text-gray-700 text-sm">
                ← Kembali
            </a>

            <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                Update Alamat
            </button>

        </div>

    </form>

</div>

@endsection
@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    <!-- HEADER -->
    <div class="flex flex-col gap-3 mb-8">

<div class="flex items-center gap-3">

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

    <!-- TITLE -->
    <h2 class="text-xl md:text-2xl font-semibold text-gray-800 capitalize">
        Kategori 
        <span class="text-red-600 font-bold">
            {{ $kategori }}
        </span>
    </h2>

</div>

    </div>


    <!-- GRID -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-5">

        @forelse ($produk as $item)

        <a href="{{ route('produk.show', $item->id) }}"
           class="bg-white rounded-xl border hover:shadow-lg hover:-translate-y-1 transition duration-200 overflow-hidden group">

            <!-- IMAGE -->
            <div class="h-40 bg-gray-50 flex items-center justify-center p-3">
                <img src="{{ asset('storage/' . $item->gambar_1) }}"
                     class="max-h-full max-w-full object-contain group-hover:scale-105 transition duration-300">
            </div>

            <!-- CONTENT -->
            <div class="p-3 space-y-1">

                <p class="text-sm text-gray-700 line-clamp-2 min-h-[40px]">
                    {{ $item->nama_produk }}
                </p>

                <p class="font-semibold text-red-600 text-sm">
                    Rp {{ number_format($item->harga) }}
                </p>

            </div>

        </a>

        @empty

        <div class="col-span-full text-center py-12">

            <div class="flex flex-col items-center gap-3 text-gray-400">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M20 13V7a2 2 0 00-1-1.7l-7-4a2 2 0 00-2 0l-7 4A2 2 0 002 7v6a2 2 0 001 1.7l7 4a2 2 0 002 0l7-4a2 2 0 001-1.7z"/>
                </svg>

                <p class="text-sm">Tidak ada produk di kategori ini</p>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection
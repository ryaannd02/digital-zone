@extends('customer.layout')

@section('content')

<div class="max-w-7xl mx-auto py-10 px-4 md:px-6">

    {{-- HEADER --}}
<div class="mb-8">

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
            Hasil pencarian
        </h2>

    </div>

    <!-- QUERY -->
    <p class="text-sm text-gray-500 mt-2 ml-9">
        "{{ $q }}"
    </p>

</div>

    {{-- FILTER --}}
    <div class="flex flex-wrap gap-3 mb-8">

        {{-- SORT --}}
        <a href="{{ $sort == 'termurah' 
    ? route('search', ['q'=>$q, 'kategori'=>$kategori]) 
    : route('search', ['q'=>$q, 'sort'=>'termurah', 'kategori'=>$kategori]) }}"
           class="px-4 py-2 rounded-full text-sm border transition
           {{ $sort=='termurah' 
                ? 'bg-red-600 text-white border-red-600' 
                : 'bg-white text-gray-600 hover:bg-gray-50' }}">
            Termurah
        </a>

        <a href="{{ $sort == 'termahal' 
    ? route('search', ['q'=>$q, 'kategori'=>$kategori]) 
    : route('search', ['q'=>$q, 'sort'=>'termahal', 'kategori'=>$kategori]) }}"
           class="px-4 py-2 rounded-full text-sm border transition
           {{ $sort=='termahal' 
                ? 'bg-red-600 text-white border-red-600' 
                : 'bg-white text-gray-600 hover:bg-gray-50' }}">
            Termahal
        </a>

        {{-- KATEGORI --}}
        @foreach($kategoris as $kat)
            <a href="{{ $kategori == $kat->id 
    ? route('search', ['q'=>$q, 'sort'=>$sort]) 
    : route('search', ['q'=>$q, 'kategori'=>$kat->id, 'sort'=>$sort]) }}"
               class="px-4 py-2 rounded-full text-sm border transition
               {{ $kategori == $kat->id 
                    ? 'bg-red-600 text-white border-red-600' 
                    : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                {{ $kat->nama_kategori }}
            </a>
        @endforeach

    </div>

    {{-- PRODUK --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @forelse ($produks as $produk)

            <a href="{{ route('produk.show', $produk->id) }}"
               class="bg-white rounded-2xl border hover:shadow-lg hover:-translate-y-1 transition overflow-hidden">

                {{-- IMAGE --}}
                <div class="h-40 bg-gray-50 flex items-center justify-center p-3">
                    <img src="{{ asset('storage/' . $produk->gambar_1) }}"
                         class="max-h-full max-w-full object-contain transition duration-300 hover:scale-105">
                </div>

                {{-- CONTENT --}}
                <div class="p-3">

                    <p class="text-sm text-gray-700 line-clamp-2">
                        {{ $produk->nama_produk }}
                    </p>

                    <p class="font-semibold text-red-600 mt-1">
                        Rp {{ number_format($produk->harga) }}
                    </p>

                </div>

            </a>

        @empty

            <div class="col-span-4 text-center py-20 text-gray-400">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-12 h-12 mx-auto mb-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M9 13h6m-3-3v6m-9 4h18"/>

                </svg>

                Produk tidak ditemukan

            </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-10">
        {{ $produks->links() }}
    </div>

</div>

@endsection
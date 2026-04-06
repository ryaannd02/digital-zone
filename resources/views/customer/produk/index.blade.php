@extends('customer.layout')

@section('content')

<h2 class="text-2xl font-bold mb-4">Semua Produk</h2>

<div class="grid grid-cols-4 gap-4">
    @foreach ($produk as $item)
        <div class="bg-white p-4 shadow rounded">
            <img src="{{ $item->gambar }}" class="h-40 w-full object-cover mb-2">
            <h3 class="font-bold">{{ $item->nama_produk }}</h3>
            <p class="text-green-600">Rp {{ number_format($item->harga) }}</p>

            <a href="{{ route('produk.show', $item->id) }}"
               class="block mt-2 bg-black text-white text-center py-1 rounded">
               Detail
            </a>
        </div>
    @endforeach
</div>

@endsection

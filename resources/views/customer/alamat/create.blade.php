@extends('guest.layout')

@section('content')

<div class="max-w-3xl mx-auto py-10">

    <h2 class="text-2xl font-bold text-[#F5AD1B] mb-8">
        Tambah Alamat
    </h2>

    <form action="{{ route('alamat.store') }}" method="POST"
          class="bg-white shadow rounded-xl p-8 space-y-6">
        @csrf

        <div>
            <label class="block mb-2 font-semibold">Nama Penerima</label>
            <input type="text" name="nama_penerima"
                   class="w-full border rounded-lg p-3"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">No Telepon</label>
            <input type="text" name="no_telepon"
                   class="w-full border rounded-lg p-3"
                   required>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Alamat Lengkap</label>
            <textarea name="alamat_lengkap"
                      class="w-full border rounded-lg p-3"
                      rows="4"
                      required></textarea>
        </div>

        <div>
            <label class="block mb-2 font-semibold">Label</label>
            <select name="label"
                    class="w-full border rounded-lg p-3"
                    required>
                <option value="rumah">Rumah</option>
                <option value="kantor">Kantor</option>
            </select>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('alamat.index') }}"
               class="text-gray-600">
                ← Kembali
            </a>

            <button class="bg-[#AA1B25] text-white px-6 py-3 rounded-lg">
                Simpan
            </button>
        </div>

    </form>

</div>

@endsection
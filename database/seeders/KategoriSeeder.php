<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create(['nama_kategori' => 'Handphone']);
        Kategori::create(['nama_kategori' => 'Laptop']);
        Kategori::create(['nama_kategori' => 'Smartwatch']);
        Kategori::create(['nama_kategori' => 'Aksesoris']);
    }
}

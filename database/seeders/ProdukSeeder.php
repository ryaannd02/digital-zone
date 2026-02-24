<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'kategori_id' => 1,
            'nama_produk' => 'iPhone 13',
            'deskripsi' => 'iPhone 13 original 128GB',
            'harga' => 12000000,
            'stok' => 5,
            'gambar_1' => 'https://via.placeholder.com/300',
            'gambar_2' => 'https://via.placeholder.com/300',
            'gambar_3' => 'https://via.placeholder.com/300',
        ]);

        Produk::create([
            'kategori_id' => 1,
            'nama_produk' => 'Samsung S23',
            'deskripsi' => 'Samsung original',
            'harga' => 11000000,
            'stok' => 3,
            'gambar_1' => 'https://via.placeholder.com/300',
            'gambar_2' => 'https://via.placeholder.com/300',
            'gambar_3' => 'https://via.placeholder.com/300',
        ]);

        Produk::create([
            'kategori_id' => 1,
            'nama_produk' => 'Xiaomi 13',
            'deskripsi' => 'Xiaomi flagship',
            'harga' => 8000000,
            'stok' => 7,
            'gambar_1' => 'https://via.placeholder.com/300',
            'gambar_2' => 'https://via.placeholder.com/300',
            'gambar_3' => 'https://via.placeholder.com/300',
        ]);
    }
}
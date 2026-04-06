<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |----------------------------------------------------------
        | User Testing (Customer)
        |----------------------------------------------------------
        */
        User::create([
            'name' => 'Achmad Riyandi',
            'email' => 'riyandiachmad448@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        /*
        |----------------------------------------------------------
        | Panggil Seeder Produk
        |----------------------------------------------------------
        */
        $this->call([
            KategoriSeeder::class,
            ProdukSeeder::class,
        ]);


        $this->call([
            AdminSeeder::class,
        ]);
    
    }
}

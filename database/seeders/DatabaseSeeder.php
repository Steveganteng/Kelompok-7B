<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Obat;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GolonganSeeder::class,
            PenandaSeeder::class,
            SatuanSeeder::class,
            LokasiSeeder::class,
            ObatSeeder::class,
            ProdukKesehatanSeeder::class,
            AlatKesehatanSeeder::class,


        ]);
    }

}

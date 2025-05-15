<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lokasi::create([
            'area' => 'Gudang A',
            'rak' => 'R1',
            'baris' => 1,
            'kolom' => 1,
            'deskripsi' => 'Dekat pintu masuk',
        ]);

        Lokasi::create([
            'area' => 'Gudang B',
            'rak' => 'R2',
            'baris' => 2,
            'kolom' => 3,
            'deskripsi' => 'Bagian belakang',
        ]);
    }
}

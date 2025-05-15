<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukKesehatan;
use App\Models\Lokasi;
use App\Models\Satuan;
use Faker\Factory as Faker;

class ProdukKesehatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $lokasiIds = Lokasi::pluck('id_lokasi')->toArray();
        $satuanIds = Satuan::pluck('id_satuan')->toArray();

        $namaProdukList = [
            'Paracetamol', 'Ibuprofen', 'Amoxicillin', 'Cetirizine', 'Aspirin',
            'Vitamin C', 'Omeprazole', 'Salep Luka', 'Minyak Kayu Putih',
            'Syrup Batuk', 'Kapsul Omega 3', 'Salep Gatal', 'Obat Sakit Kepala',
            'Suplemen Zink', 'Obat Maag', 'Salep Antiseptik', 'Obat Flu', 'Salep Luka Bakar'
        ];

        $jumlah = 100;

        for ($i = 0; $i < $jumlah; $i++) {
            ProdukKesehatan::create([
                'nama'      => $faker->randomElement($namaProdukList),
                'stok'      => $faker->numberBetween(10, 200),
                'gambar'    => 'default.jpg',
                'lokasi_id' => $faker->randomElement($lokasiIds),
                'satuan_id' => $faker->randomElement($satuanIds),
            ]);
        }
    }
}

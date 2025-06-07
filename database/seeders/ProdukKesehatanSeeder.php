<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProdukKesehatan;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Faker\Factory as Faker;

class ProdukKesehatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua ID dari tabel relasi
        $golonganIds = Golongan::pluck('id_golongan')->toArray();
        $penandaIds  = Penanda::pluck('id_penanda')->toArray();
        $lokasiIds   = Lokasi::pluck('id_lokasi')->toArray();
        $satuanIds   = Satuan::pluck('id_satuan')->toArray();

        $genericList = [
            'Hand Sanitizer', 'Masker Medis', 'Disinfektan Spray', 'Plester Luka',
            'Alkohol 70%', 'Kapas', 'Tisu Basah Antiseptik', 'Salep Antiseptik',
            'Minyak Kayu Putih', 'Balsem', 'Obat Luka Bakar', 'Povidone Iodine'
        ];

        $distributorList = [
            'Kimia Farma', 'OneMed', 'Kalbe Medika', 'Sanbe Farma',
            'Indofarma', 'Dexa Medica', 'Phapros', 'Mandala Medika'
        ];

        for ($i = 1; $i <= 50; $i++) {
            $generic = $faker->randomElement($genericList);
            $brandSuffix = $faker->randomElement(['Care', 'Plus', 'Safe', 'Shield', 'Max']);
            $namaDagang = "{$generic} {$brandSuffix}";

            ProdukKesehatan::create([
                'kode_produkkesehatan'        => 'PRD' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama_produkkesehatan'        => $generic,
                'stok'                        => $faker->numberBetween(20, 300),
                'harga'                       => $faker->numberBetween(3000, 150000),
                'bobot_isi'                   => $faker->numberBetween(50, 500),
                'gambar'                      => 'default.jpg',
                'distributor_produkkesehatan' => $faker->randomElement($distributorList),
                'golongan_id'                 => $faker->randomElement($golonganIds),
                'penanda_id'                  => $faker->randomElement($penandaIds),
                'lokasi_id'                   => $faker->randomElement($lokasiIds),
                'satuan_id'                   => $faker->randomElement($satuanIds),
                'tgl_kadaluarsa'              => $faker->dateTimeBetween('now', '+3 years')->format('Y-m-d'),
            ]);
        }
    }
}

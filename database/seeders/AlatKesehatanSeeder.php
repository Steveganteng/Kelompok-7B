<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatKesehatan;
use App\Models\Lokasi;
use Faker\Factory as Faker;

class AlatKesehatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $lokasiIds = Lokasi::pluck('id_lokasi')->toArray();

        $alatList = [
            'Tensimeter', 'Termometer', 'Stetoskop', 'Nebulizer', 'Alat Cek Gula Darah',
            'Suction Pump', 'Infusion Set', 'Alat Cek Kolesterol', 'Oximeter', 'Alat EKG',
            'Lampu Operasi', 'Sterilizer', 'Timbangan Bayi', 'Kursi Roda', 'Meja Operasi',
            'Alat Cek Asam Urat', 'Masker Oksigen', 'Sfigmomanometer', 'Alat USG', 'Pompa ASI'
        ];

        $distributorList = [
            'Meditek', 'Berca Medika', 'Nipro', 'OneMed', 'Kimia Farma Medika',
            'Kalbe Medika', 'Mandala Medika', 'Trans Medika', 'RSUP Distributor'
        ];

        $jenisList = ['Disposable', 'Non-Disposable'];
        $statusList = ['Unavalaible', 'Avalaible'];

        for ($i = 1; $i <= 50; $i++) {
            $namaAlat = $faker->randomElement($alatList);

            AlatKesehatan::create([
                'kode_alat'        => 'ALT' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama'             => $namaAlat,
                'jenis'            => $faker->randomElement($jenisList),
                'distributor_alat' => $faker->randomElement($distributorList),
                'stok'             => $faker->numberBetween(5, 100),
                'gambar'           => 'default.jpg', // Kamu bisa sesuaikan atau pake faker image
                'lokasi_id'        => $faker->randomElement($lokasiIds),
                'status'           => $faker->randomElement($statusList),
            ]);
        }
    }
}

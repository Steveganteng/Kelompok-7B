<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlatKesehatan;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Faker\Factory as Faker;

class AlatKesehatanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua ID dari tabel relasi sebagai sumber data
        $golonganIds = Golongan::pluck('id_golongan')->toArray();
        $penandaIds  = Penanda::pluck('id_penanda')->toArray();
        $lokasiIds   = Lokasi::pluck('id_lokasi')->toArray();
        $satuanIds   = Satuan::pluck('id_satuan')->toArray();

        // Contoh nama alat kesehatan (bisa ditambah sesuai kebutuhan)
        $namaAlkesList = [
            'Tensimeter Digital', 'Stetoskop', 'Termometer Infrared', 'Alat Cek Gula Darah',
            'Oximeter', 'Nebulizer', 'Timbangan Digital', 'Sphygmomanometer',
            'Alat Ukur Tinggi Badan', 'Lampu Periksa', 'Sterilizer UV', 'Suction Pump',
            'Infusion Set', 'Bed Pasien', 'Alat Tes Kehamilan', 'Masker Oksigen'
        ];

        // Loop untuk menghasilkan 50 data alat kesehatan acak
        for ($i = 0; $i < 50; $i++) {
            AlatKesehatan::create([
                'nama'         => $faker->randomElement($namaAlkesList),
                'jenis'        => $faker->randomElement(['Elektronik', 'Manual', 'Digital', 'Portabel']),
                'stok'         => $faker->numberBetween(1, 100),
                'deskripsi'    => $faker->sentence(10),
                'gambar'       => 'default_alkes.jpg',
                'golongan_id'  => $faker->randomElement($golonganIds),
                'penanda_id'   => $faker->randomElement($penandaIds),
                'lokasi_id'    => $faker->randomElement($lokasiIds),
                'satuan_id'    => $faker->randomElement($satuanIds),
                'status'       => $faker->randomElement(['Aktif', 'Nonaktif']),
            ]);
        }
    }
}

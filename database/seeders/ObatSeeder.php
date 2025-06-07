<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;
use App\Models\Golongan;
use App\Models\Penanda;
use App\Models\Lokasi;
use App\Models\Satuan;
use Faker\Factory as Faker;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Ambil semua ID dari tabel relasi sebagai sumber data
        $golonganIds = Golongan::pluck('id_golongan')->toArray();
        $penandaIds  = Penanda::pluck('id_penanda')->toArray();
        $lokasiIds   = Lokasi::pluck('id_lokasi')->toArray();
        $satuanIds   = Satuan::pluck('id_satuan')->toArray();

        $genericList = [
            'Paracetamol', 'Ibuprofen', 'Amoxicillin', 'Cetirizine', 'Aspirin',
            'Metformin', 'Omeprazole', 'Loperamide', 'Diazepam', 'Simvastatin',
            'Ciprofloxacin', 'Clindamycin', 'Vitamin C', 'Dexamethasone',
            'Hydrocortisone', 'Albendazole', 'Salbutamol', 'Acetaminophen',
            'Furosemide', 'Ketoconazole', 'Domperidone', 'Erythromycin',
            'Lansoprazole', 'Chlorpheniramine', 'Ranitidine', 'Mefenamic Acid',
            'Ketorolac', 'Naproxen', 'Loratadine', 'Captopril', 'Losartan',
            'Amlodipine', 'Bisoprolol', 'Atorvastatin', 'Folic Acid',
            'Prednisone', 'Fluconazole', 'Piroxicam', 'Spironolactone'
        ];

        $distributorList = [
            'Kimia Farma', 'Kalbe Farma', 'Dexa Medica', 'Phapros', 'Sanbe Farma',
            'Tempo Scan', 'Novell Pharmaceutical', 'Meiji Seika', 'Indofarma'
        ];

        for ($i = 1; $i <= 100; $i++) {
            $generic = $faker->randomElement($genericList);
            $brandSuffix = $faker->randomElement(['XR', 'SR', 'Plus', 'C', 'DS']);
            $namaDagang = "{$generic} {$brandSuffix}";

            Obat::create([
                'kode_obat'           => 'OBT' . str_pad($i, 4, '0', STR_PAD_LEFT), // e.g. OBT0001
                'nama_dagang_obat'    => $namaDagang,
                'nama_obat'           => $generic,
                'distributor_obat'    => $faker->randomElement($distributorList),
                'stok'                => $faker->numberBetween(10, 500),
                'harga'               => $faker->numberBetween(5000, 200000),
                'bobot_isi'           => $faker->numberBetween(100, 1000),
                'deskripsi'           => $faker->sentence(8),
                'gambar'              => 'default.jpg',
                'golongan_id'         => $faker->randomElement($golonganIds),
                'penanda_id'          => $faker->randomElement($penandaIds),
                'lokasi_id'           => $faker->randomElement($lokasiIds),
                'satuan_id'           => $faker->randomElement($satuanIds),
                'tgl_kadaluarsa'      => $faker->dateTimeBetween('now', '+2 years')->format('Y-m-d'),
            ]);
        }
    }
}

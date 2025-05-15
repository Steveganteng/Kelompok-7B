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

        // Daftar nama obat contoh (bisa kamu tambah atau ganti)
        $namaObatList = [
            'Paracetamol', 'Ibuprofen', 'Amoxicillin', 'Cetirizine', 'Aspirin', 'Metformin', 'Omeprazole',
            'Loperamide', 'Diazepam', 'Simvastatin', 'Ciprofloxacin', 'Clindamycin', 'Vitamin C', 'Dexamethasone',
            'Hydrocortisone', 'Albendazole', 'Salbutamol', 'Acetaminophen', 'Furosemide', 'Ketoconazole',
            'Domperidone', 'Erythromycin', 'Lansoprazole', 'Chlorpheniramine', 'Ranitidine', 'Mefenamic Acid',
            'Ketorolac', 'Naproxen', 'Loratadine', 'Antasida', 'Captopril', 'Losartan', 'Amlodipine', 'Bisoprolol',
            'Atorvastatin', 'Folic Acid', 'Prednisone', 'Fluconazole', 'Piroxicam', 'Spironolactone'
        ];

        // Loop untuk menghasilkan 100 data obat acak
        for ($i = 0; $i < 100; $i++) {
            Obat::create([
                'NamaObat'    => $faker->randomElement($namaObatList),
                'stok'        => $faker->numberBetween(10, 500),
                'harga'       => $faker->numberBetween(5000, 200000),
                'bobot_isi'   => $faker->numberBetween(100, 1000), // misal mg
                'deskripsi'   => $faker->sentence(8),
                'gambar'      => 'default.jpg', // kamu bisa buat placeholder atau upload dummy image
                'golongan_id' => $faker->randomElement($golonganIds),
                'penanda_id'  => $faker->randomElement($penandaIds),
                'lokasi_id'   => $faker->randomElement($lokasiIds),
                'satuan_id'   => $faker->randomElement($satuanIds),
            ]);
        }
    }
}

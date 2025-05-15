<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Golongan;

class GolonganSeeder extends Seeder
{
    public function run()
    {
        $golonganList = [
            'Antibiotik',
            'Analgesik',
            'Antipiretik',
            'Antiseptik',
            'Antijamur',
            'Vitamin',
            'Antialergi',
            'Antidepresan',
            'Obat Tidur',
            'Imunomodulator',
        ];

        foreach ($golonganList as $golongan) {
            Golongan::create([
                'NamaGolongan' => $golongan,
            ]);
        }
    }
}

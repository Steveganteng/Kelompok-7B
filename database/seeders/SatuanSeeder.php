<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_satuan' => 'Tablet'],
            ['nama_satuan' => 'Kapsul'],
            ['nama_satuan' => 'Botol'],
            ['nama_satuan' => 'Strip'],
        ];

        foreach ($data as $item) {
            Satuan::create($item);
        }
    }
}

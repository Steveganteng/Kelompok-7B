<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penanda;

class PenandaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_penanda' => 'Biru'],
            ['nama_penanda' => 'Merah'],
        ];

        foreach ($data as $item) {
            Penanda::create($item);
        }
    }
}

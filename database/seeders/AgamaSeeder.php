<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['agama' => 'Islam'],
            ['agama' => 'Kristen Protestan'],
            ['agama' => 'Kristen Katolik'],
            ['agama' => 'Hindu'],
            ['agama' => 'Buddha'],
            ['agama' => 'Konghucu'],
        ];

        foreach ($data as $item) {
            Agama::create($item);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Subunit;
use Illuminate\Database\Seeder;

class SubunitSeeder extends Seeder
{
    public function run(): void
    {
        // Error anjay:v
        $data = [
            ['unit_id' => 1, 'subunit' => 'Ketua'],
            ['unit_id' => 1, 'subunit' => 'Wakil Ketua'],
            ['unit_id' => 2, 'subunit' => 'Ketua_2'],
            ['unit_id' => 2, 'subunit' => 'Wakil Ketua_2'],
            ['unit_id' => 3, 'subunit' => 'Ketua_3'],
            ['unit_id' => 3, 'subunit' => 'Wakil Ketua_3'],
            ['unit_id' => 4, 'subunit' => 'Ketua_4'],
            ['unit_id' => 4, 'subunit' => 'Wakil Ketua_4'],
        ];

        foreach ($data as $item) {
            Subunit::create($item);
        }
    }
}

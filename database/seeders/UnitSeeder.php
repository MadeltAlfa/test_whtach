<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['unit' => 'Divisi Cyber'],
            ['unit' => 'Divisi Jaringan'],
            ['unit' => 'Divisi Web Teknologi'],
            ['unit' => 'Divisi Desain'],
        ];

        foreach ($data as $item) {
            Unit::create($item);
        }
    }
}

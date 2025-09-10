<?php

namespace Database\Seeders;

use App\Models\JenisPegawai;
use Illuminate\Database\Seeder;

class JenisPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['jenis_pegawai' => 'Magang'],
            ['jenis_pegawai' => 'Magang Lulusan'],
        ];

        foreach ($data as $item) {
            JenisPegawai::create($item);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\StatusPegawai;
use Illuminate\Database\Seeder;

class StatusPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['jenis_pegawai_id' => 1, 'status_pegawai' => 'Magang Mahasiswa'],
            ['jenis_pegawai_id' => 2, 'status_pegawai' => 'Magang SMK'],
            ['jenis_pegawai_id' => 3, 'status_pegawai' => 'Magang Siswa'],
            ['jenis_pegawai_id' => 4, 'status_pegawai' => 'Magang Lulusan'],
        ];

        foreach ($data as $item) {
            StatusPegawai::create($item);
        }
    }
}

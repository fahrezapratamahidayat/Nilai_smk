<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\User;

class NilaiTableSeeder extends Seeder
{
    public function run()
    {
        $siswa = User::where('role', 'siswa')->get();
        $mapel = [
            'Matematika',
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Produktif RPL',
            'Basis Data',
            'Pemrograman Web'
        ];

        foreach ($siswa as $s) {
            foreach ($mapel as $m) {
                Nilai::create([
                    'user_id' => $s->id,
                    'mata_pelajaran' => $m,
                    'nilai' => rand(75, 100),
                    'semester' => 'ganjil',
                    'tahun_ajaran' => '2023/2024'
                ]);
            }
        }
    }
}

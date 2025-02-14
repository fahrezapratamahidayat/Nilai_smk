<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\User;
use App\Models\Siswa;

class NilaiTableSeeder extends Seeder
{
    public function run()
    {
        $siswa = Siswa::with('user')->get();
        $guru = User::where('role', 'guru')->first();

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
                    'siswa_id' => $s->user_id,
                    'guru_id' => $guru->id,
                    'mata_pelajaran' => $m,
                    'nilai' => rand(75, 100),
                    'semester' => '1',
                    'tahun_ajaran' => '2023/2024'
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@smk.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Wali Kelas
        User::create([
            'name' => 'Wali Kelas 10 RPL',
            'email' => 'walikelas@smk.com',
            'password' => Hash::make('walikelas123'),
            'role' => 'walikelas',
            'nip' => '198603202011012003',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '1986-03-20',
            'tempat_lahir' => 'Bandung',
            'alamat' => 'Jl. Guru No. 456, Bandung',
            'kelas' => '10 RPL',
            'kelas_ajar' => '10',
            'status_guru' => 'wali_kelas'
        ]);

        // Guru
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'guru@smk.com',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
            'nip' => '198501152010011002',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1985-01-15',
            'tempat_lahir' => 'Jakarta',
            'alamat' => 'Jl. Pendidikan No. 123, Jakarta',
            'mata_pelajaran' => 'Matematika',
            'kelas_ajar' => '10',
            'status_guru' => 'guru_mapel'
        ]);

        // Siswa
        $siswa = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'siswa1@smk.com',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siswa2@smk.com',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ],
            [
                'name' => 'Muhammad Fajar',
                'email' => 'siswa3@smk.com',
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
            ]
        ];

        foreach ($siswa as $s) {
            User::create($s);
        }
    }
}

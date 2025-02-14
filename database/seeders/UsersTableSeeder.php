<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use App\Models\Siswa;
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
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1990-01-01',
            'tempat_lahir' => 'Jakarta',
            'alamat' => 'Jl. Admin No. 123'
        ]);

        // Guru dan Wali Kelas
        $guru1 = User::create([
            'name' => 'Wali Kelas 10 RPL',
            'email' => 'walikelas@smk.com',
            'password' => Hash::make('walikelas123'),
            'role' => 'walikelas',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '1986-03-20',
            'tempat_lahir' => 'Bandung',
            'alamat' => 'Jl. Guru No. 456, Bandung'
        ]);

        Guru::create([
            'user_id' => $guru1->id,
            'nip' => '198603202011012003',
            'mata_pelajaran' => 'Matematika',
            'kelas_ajar' => '10',
            'status_guru' => 'wali_kelas'
        ]);

        $guru2 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'guru@smk.com',
            'password' => Hash::make('guru123'),
            'role' => 'guru',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1985-01-15',
            'tempat_lahir' => 'Jakarta',
            'alamat' => 'Jl. Pendidikan No. 123, Jakarta'
        ]);

        Guru::create([
            'user_id' => $guru2->id,
            'nip' => '198501152010011002',
            'mata_pelajaran' => 'Bahasa Indonesia',
            'kelas_ajar' => '10',
            'status_guru' => 'guru_mapel'
        ]);

        // Siswa
        $siswaData = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'siswa1@smk.com',
                'nis' => '2024001',
                'kelas' => '10'
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siswa2@smk.com',
                'nis' => '2024002',
                'kelas' => '10'
            ],
            [
                'name' => 'Muhammad Fajar',
                'email' => 'siswa3@smk.com',
                'nis' => '2024003',
                'kelas' => '10'
            ]
        ];

        foreach ($siswaData as $data) {
            $siswa = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('siswa123'),
                'role' => 'siswa',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2007-01-01',
                'tempat_lahir' => 'Jakarta',
                'alamat' => 'Jl. Siswa No. 123'
            ]);

            Siswa::create([
                'user_id' => $siswa->id,
                'nis' => $data['nis'],
                'kelas' => $data['kelas']
            ]);
        }
    }
}

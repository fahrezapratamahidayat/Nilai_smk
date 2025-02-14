<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Gallery;
use App\Models\Guru;
use Carbon\Carbon;

class SiswaController extends Controller
{
    public function dashboard()
    {
        // Ambil data siswa yang login
        $siswa = auth()->user();
        $kelasSiswa = $siswa->siswa->kelas;

        // Hitung rata-rata nilai
        $nilaiRataRata = Nilai::where('siswa_id', auth()->id())
            ->avg('nilai');

        // Hitung jumlah mata pelajaran berdasarkan guru yang mengajar di kelas siswa
        $jumlahMapel = Guru::where('kelas_ajar', substr($kelasSiswa, 0, 2)) // Ambil 2 digit pertama (10/11/12)
            ->where('status_guru', 'guru_mapel')
            ->distinct('mata_pelajaran')
            ->count('mata_pelajaran');

        // Data untuk jadwal
        $jadwalHariIni = Guru::where('kelas_ajar', substr($kelasSiswa, 0, 2))
            ->where('status_guru', 'guru_mapel')
            ->with('user')
            ->get()
            ->map(function($guru) {
                return [
                    'jam' => '07:00 - 08:30', // Ini bisa disesuaikan dengan tabel jadwal jika ada
                    'mapel' => $guru->mata_pelajaran,
                    'guru' => $guru->user->name,
                    'ruangan' => 'R.101' // Ini bisa disesuaikan dengan tabel ruangan jika ada
                ];
            });

        return view('siswa.dashboard', compact('siswa', 'nilaiRataRata', 'jumlahMapel', 'jadwalHariIni'));
    }

    public function gallery()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(6);
        return view('siswa.gallery', compact('galleries'));
    }

    public function nilai(Request $request)
    {
        $semester = $request->get('semester', '1'); // Default semester ganjil
        $tahunAjaran = $request->get('tahun_ajaran', '2023/2024'); // Default tahun ajaran

        $nilai = Nilai::where('siswa_id', auth()->id())
            ->where('semester', $semester)
            ->where('tahun_ajaran', $tahunAjaran)
            ->get();

        // Ambil daftar tahun ajaran yang tersedia
        $tahunAjaranList = Nilai::where('siswa_id', auth()->id())
            ->distinct()
            ->pluck('tahun_ajaran');

        return view('siswa.nilai', compact('nilai', 'semester', 'tahunAjaran', 'tahunAjaranList'));
    }

    private function hitungGrade($nilai)
    {
        if ($nilai >= 90) return 'A';
        if ($nilai >= 80) return 'B';
        if ($nilai >= 70) return 'C';
        if ($nilai >= 60) return 'D';
        return 'E';
    }
}

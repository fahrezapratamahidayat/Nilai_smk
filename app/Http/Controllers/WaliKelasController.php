<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
{
    public function dashboard()
    {
        $walikelas = auth()->user();
        $kelas = $walikelas->guru->kelas_ajar;

        // Ambil siswa berdasarkan kelas yang diajar
        $siswa = User::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', 'like', $kelas . '%');
        })->with('siswa')->get();

        return view('walikelas.dashboard', compact('siswa'));
    }

    public function leger(Request $request)
    {
        $walikelas = auth()->user();
        $kelas = $walikelas->guru->kelas_ajar;
        $semester = $request->get('semester', '1');
        $tahunAjaran = $request->get('tahun_ajaran', '2023/2024');

        // Ambil semua siswa di kelas
        $siswa = User::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', 'like', $kelas . '%');
        })->with('siswa')->get();

        // Ambil semua mata pelajaran yang ada
        $mataPelajaran = Nilai::where('semester', $semester)
            ->where('tahun_ajaran', $tahunAjaran)
            ->distinct('mata_pelajaran')
            ->pluck('mata_pelajaran');

        // Ambil nilai untuk setiap siswa
        $nilaiSiswa = [];
        $rataRataSiswa = [];

        foreach ($siswa as $s) {
            $nilai = Nilai::where('siswa_id', $s->id)
                ->where('semester', $semester)
                ->where('tahun_ajaran', $tahunAjaran)
                ->get()
                ->keyBy('mata_pelajaran');

            $nilaiSiswa[$s->id] = $nilai;

            // Hitung rata-rata nilai siswa
            $rataRata = $nilai->avg('nilai');
            $rataRataSiswa[$s->id] = round($rataRata, 2);
        }

        // Urutkan siswa berdasarkan rata-rata (untuk peringkat)
        arsort($rataRataSiswa);
        $peringkat = array_keys($rataRataSiswa);

        // Untuk download PDF
        if ($request->has('download')) {
            $pdf = PDF::loadView('walikelas.leger-pdf', compact(
                'siswa',
                'mataPelajaran',
                'nilaiSiswa',
                'rataRataSiswa',
                'peringkat',
                'semester',
                'tahunAjaran',
                'kelas'
            ));

            return $pdf->download("leger_{$kelas}_{$semester}_{$tahunAjaran}.pdf");
        }

        return view('walikelas.leger', compact(
            'siswa',
            'mataPelajaran',
            'nilaiSiswa',
            'rataRataSiswa',
            'peringkat',
            'semester',
            'tahunAjaran'
        ));
    }

    public function rapot(Request $request)
    {
        $walikelas = auth()->user();
        $kelas = $walikelas->guru->kelas_ajar;

        // Ambil siswa berdasarkan kelas
        $siswa = User::whereHas('siswa', function($query) use ($kelas) {
            $query->where('kelas', 'like', $kelas . '%');
        })->with('siswa')->get();

        if ($request->has('siswa_id')) {
            $selectedSiswa = User::with('siswa')->findOrFail($request->siswa_id);
            $semester = $request->get('semester', '1');
            $tahunAjaran = $request->get('tahun_ajaran', '2023/2024');

            $nilai = Nilai::with('guru')
                ->where('siswa_id', $selectedSiswa->id)
                ->where('semester', $semester)
                ->where('tahun_ajaran', $tahunAjaran)
                ->get();

            if ($request->has('download')) {
                $pdf = PDF::loadView('walikelas.rapot-pdf', [
                    'siswa' => $selectedSiswa,
                    'nilai' => $nilai,
                    'semester' => $semester,
                    'tahunAjaran' => $tahunAjaran,
                    'walikelas' => $walikelas,
                    'rataRata' => $nilai->avg('nilai')
                ]);

                return $pdf->download("rapor_{$selectedSiswa->name}_{$semester}_{$tahunAjaran}.pdf");
            }

            return view('walikelas.rapot', compact('siswa', 'selectedSiswa', 'nilai', 'semester', 'tahunAjaran'));
        }

        return view('walikelas.rapot', compact('siswa'));
    }

    private function hitungGrade($nilai)
    {
        if ($nilai >= 90) return ['A', 'Sangat Baik'];
        if ($nilai >= 80) return ['B', 'Baik'];
        if ($nilai >= 70) return ['C', 'Cukup'];
        if ($nilai >= 60) return ['D', 'Kurang'];
        return ['E', 'Sangat Kurang'];
    }
}

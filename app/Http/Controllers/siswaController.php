<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Gallery;
use App\Models\Guru;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function downloadRapor(Request $request)
    {
        try {
            $siswa = auth()->user()->load('siswa');
            $semester = $request->get('semester', '1');
            $tahunAjaran = $request->get('tahun_ajaran', '2023/2024');

            $nilai = Nilai::with('guru')
                ->where('siswa_id', $siswa->id)
                ->where('semester', $semester)
                ->where('tahun_ajaran', $tahunAjaran)
                ->get();

            if ($nilai->isEmpty()) {
                if ($request->ajax()) {
                    return response()->json(['error' => 'Tidak ada data nilai'], 404);
                }
                return back()->with('error', 'Tidak ada data nilai untuk semester dan tahun ajaran yang dipilih');
            }

            $data = [
                'siswa' => $siswa,
                'nilai' => $nilai,
                'semester' => $semester,
                'tahunAjaran' => $tahunAjaran,
                'rataRata' => $nilai->avg('nilai')
            ];

            $pdf = Pdf::loadView('siswa.rapor-pdf', $data);
            $pdf->setPaper('A4', 'portrait');

            if ($request->ajax()) {
                $output = base64_encode($pdf->output());
                return response()->json([
                    'success' => true,
                    'file' => $output,
                    'filename' => "rapor_{$siswa->name}_{$semester}_{$tahunAjaran}.pdf"
                ]);
            }

            return $pdf->stream("rapor_{$siswa->name}_{$semester}_{$tahunAjaran}.pdf");

        } catch (\Exception $e) {
            \Log::error('Error generating rapor: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            if ($request->ajax()) {
                return response()->json(['error' => 'Terjadi kesalahan saat membuat rapor'], 500);
            }
            return back()->with('error', 'Terjadi kesalahan saat membuat rapor');
        }
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

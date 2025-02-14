<?php

// app/Http/Controllers/GuruController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalNilai = Nilai::where('guru_id', auth()->id())->count();

        return view('guru.dashboard', compact('totalSiswa', 'totalNilai'));
    }

    public function profile()
    {
        $guru = auth()->user();
        return view('guru.profile', compact('guru'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:6|confirmed',
        ]);

        $guru = auth()->user();
        $guru->name = $request->name;
        $guru->email = $request->email;

        if ($request->filled('password')) {
            $guru->password = bcrypt($request->password);
        }

        $guru->save();

        return redirect()->route('guru.profile')->with('success', 'Profile berhasil diupdate');
    }

    public function siswa(Request $request)
    {
        $query = User::with('siswa')
            ->where('role', 'siswa');

        // Filter berdasarkan kelas yang dipilih
        if ($request->filled('kelas')) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        } else {
            // Jika guru adalah wali kelas, default tampilkan siswa di kelasnya
            if (auth()->user()->guru->status_guru == 'wali_kelas') {
                $query->whereHas('siswa', function($q) {
                    $q->where('kelas', auth()->user()->guru->kelas_ajar);
                });
            }
        }

        $siswa = $query->get();

        // Ambil daftar kelas yang tersedia
        $kelas = User::join('siswa', 'users.id', '=', 'siswa.user_id')
            ->where('users.role', 'siswa')
            ->select('siswa.kelas')
            ->distinct()
            ->pluck('kelas');

        return view('guru.siswa', compact('siswa', 'kelas'));
    }

    public function nilai()
    {
        $guru = auth()->user()->guru;
        $mataPelajaran = $guru->mata_pelajaran;
        $kelasAjar = $guru->kelas_ajar; // Kelas yang diajar guru (10/11/12)

        // Ambil siswa yang kelasnya sesuai dengan kelas yang diajar guru
        $siswaList = User::with('siswa')
            ->where('role', 'siswa')
            ->whereHas('siswa', function($query) use ($kelasAjar) {
                // Contoh: Jika guru mengajar kelas 10, ambil siswa yang kelasnya dimulai dengan "10"
                $query->where('kelas', 'like', $kelasAjar . '%');
            })
            ->get();

        // Ambil nilai untuk mata pelajaran guru ini di kelas yang diajar
        $nilaiList = Nilai::where([
                'guru_id' => auth()->id(),
                'mata_pelajaran' => $mataPelajaran
            ])
            ->whereHas('siswa.siswa', function($query) use ($kelasAjar) {
                $query->where('kelas', 'like', $kelasAjar . '%');
            })
            ->with(['siswa' => function($query) {
                $query->with('siswa');
            }])
            ->get();

        return view('guru.nilai', compact('siswaList', 'nilaiList', 'mataPelajaran', 'kelasAjar'));
    }

    public function inputNilai()
    {
        $siswaList = User::where('role', 'siswa')->get();
        return view('guru.input-nilai', compact('siswaList'));
    }

    public function storeNilai(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required'
        ]);

        $guru = auth()->user()->guru;

        // Cek apakah nilai sudah ada
        $nilai = Nilai::where([
            'siswa_id' => $request->siswa_id,
            'guru_id' => auth()->id(),
            'mata_pelajaran' => $guru->mata_pelajaran,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran
        ])->first();

        if ($nilai) {
            // Update nilai yang sudah ada
            $nilai->update([
                'nilai' => $request->nilai
            ]);
        } else {
            // Buat nilai baru
            Nilai::create([
                'siswa_id' => $request->siswa_id,
                'guru_id' => auth()->id(),
                'mata_pelajaran' => $guru->mata_pelajaran,
                'nilai' => $request->nilai,
                'semester' => $request->semester,
                'tahun_ajaran' => $request->tahun_ajaran
            ]);
        }

        return redirect()->route('guru.nilai')
            ->with('success', 'Nilai berhasil diinput');
    }

    public function siswaDetail($id)
    {
        $siswa = User::with(['siswa', 'nilai' => function($query) {
            $query->where('guru_id', auth()->id());
        }])->findOrFail($id);

        return view('guru.siswa-detail', compact('siswa'));
    }

    public function editNilai($id)
    {
        $nilai = Nilai::with(['siswa.siswa'])->findOrFail($id);

        // Pastikan guru hanya bisa edit nilai yang dia input
        if ($nilai->guru_id !== auth()->id()) {
            return redirect()->route('guru.nilai')
                ->with('error', 'Anda tidak memiliki akses untuk mengedit nilai ini');
        }

        return response()->json($nilai);
    }

    public function updateNilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required'
        ]);

        $nilai = Nilai::findOrFail($id);

        // Pastikan guru hanya bisa update nilai yang dia input
        if ($nilai->guru_id !== auth()->id()) {
            return redirect()->route('guru.nilai')
                ->with('error', 'Anda tidak memiliki akses untuk mengupdate nilai ini');
        }

        $nilai->update([
            'nilai' => $request->nilai,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran
        ]);

        return redirect()->route('guru.nilai')
            ->with('success', 'Nilai berhasil diupdate');
    }

    public function destroyNilai($id)
    {
        $nilai = Nilai::findOrFail($id);

        // Pastikan guru hanya bisa hapus nilai yang dia input
        if ($nilai->guru_id !== auth()->id()) {
            return redirect()->route('guru.nilai')
                ->with('error', 'Anda tidak memiliki akses untuk menghapus nilai ini');
        }

        $nilai->delete();

        return redirect()->route('guru.nilai')
            ->with('success', 'Nilai berhasil dihapus');
    }
}

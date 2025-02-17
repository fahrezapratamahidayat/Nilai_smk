<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Guru;
use App\Models\WaliKelas;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function galleryIndex()
    {
        $galleries = Gallery::all();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function galleryCreate()
    {
        return view('admin.gallery.create');
    }

    public function galleryStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/gallery', $filename);
            $validated['image'] = $filename;
        }

        Gallery::create($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil ditambahkan');
    }

    public function galleryDestroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete the image file
        if ($gallery->image) {
            Storage::delete('public/gallery/' . $gallery->image);
        }

        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil dihapus');
    }

    public function nilaiIndex()
    {
        $nilai = Nilai::with(['siswa', 'guru'])->get();
        return view('admin.nilai.index', compact('nilai'));
    }

    public function nilaiCreate()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.nilai.create', compact('siswa'));
    }

    public function nilaiStore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_pelajaran' => 'required',
            'nilai' => 'required|integer|min:0|max:100',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required'
        ]);

        Nilai::create([
            'siswa_id' => $validated['user_id'],
            'guru_id' => auth()->id(), // mengambil ID guru yang sedang login
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'nilai' => $validated['nilai'],
            'semester' => $validated['semester'],
            'tahun_ajaran' => $validated['tahun_ajaran']
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil ditambahkan');
    }

    public function nilaiEdit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.nilai.edit', compact('nilai', 'siswa'));
    }

    public function nilaiUpdate(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_pelajaran' => 'required',
            'nilai' => 'required|integer|min:0|max:100',
            'semester' => 'required|in:1,2',
            'tahun_ajaran' => 'required'
        ]);

        $nilai->update([
            'siswa_id' => $validated['user_id'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'nilai' => $validated['nilai'],
            'semester' => $validated['semester'],
            'tahun_ajaran' => $validated['tahun_ajaran']
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diperbarui');
    }

    public function nilaiDestroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus');
    }

    // Manajemen Guru
    public function guruIndex()
    {
        $guru = User::with('guru')->where('role', 'guru')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function guruCreate()
    {
        $daftarKelas = Guru::getDaftarKelas();
        return view('admin.guru.create', compact('daftarKelas'));
    }

    public function guruStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nip' => 'required|unique:guru,nip',
            'mata_pelajaran' => 'required',
            'kelas_ajar' => 'required|in:10,11,12',
            'status_guru' => 'required|in:guru_mapel,wali_kelas',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'alamat' => 'required'
        ]);

        // Buat user baru
        $userData = array_merge(
            array_intersect_key($validated, array_flip([
                'name', 'email', 'jenis_kelamin',
                'tempat_lahir', 'tanggal_lahir', 'alamat'
            ])),
            [
                'role' => 'guru',
                'password' => Hash::make($validated['password'])
            ]
        );

        $user = User::create($userData);

        // Buat data guru
        $user->guru()->create([
            'nip' => $validated['nip'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'kelas_ajar' => $validated['kelas_ajar'],
            'status_guru' => $validated['status_guru']
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    public function guruEdit(User $guru)
    {
        $guru->load('guru');
        $daftarKelas = Guru::getDaftarKelas();
        return view('admin.guru.edit', compact('guru', 'daftarKelas'));
    }

    public function guruUpdate(Request $request, User $guru)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $guru->id,
            'nip' => 'required|unique:guru,nip,' . $guru->guru->id,
            'mata_pelajaran' => 'required',
            'kelas_ajar' => 'required|in:10,11,12',
            'status_guru' => 'required|in:guru_mapel,wali_kelas',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'alamat' => 'required'
        ]);

        // Update user data
        $userData = array_intersect_key($validated, array_flip([
            'name', 'email', 'jenis_kelamin',
            'tempat_lahir', 'tanggal_lahir', 'alamat'
        ]));

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $guru->update($userData);

        $guru->guru->update([
            'nip' => $validated['nip'],
            'mata_pelajaran' => $validated['mata_pelajaran'],
            'kelas_ajar' => $validated['kelas_ajar'],
            'status_guru' => $validated['status_guru']
        ]);

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil diupdate');
    }

    public function guruDestroy(User $guru)
    {
        $guru->guru()->delete();
        $guru->delete();

        return redirect()->route('admin.guru.index')
            ->with('success', 'Data guru berhasil dihapus');
    }

    // Manajemen Wali Kelas
    public function walikelasIndex()
    {
        $walikelas = WaliKelas::all();

        return view('admin.walikelas.index', compact('walikelas'));
    }

    public function walikelasCreate()
    {
        return view('admin.walikelas.create');
    }

    public function walikelasStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:wali_kelas,email',
            'password' => 'required|min:6',
            'kelas_ajar' => 'required|in:10,11,12',
        ]);

        WaliKelas::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'kelas_ajar' => $validated['kelas_ajar'],
        ]);

        return redirect()->route('admin.walikelas.index')->with('success', 'Wali Kelas berhasil ditambahkan');
    }

    public function walikelasEdit($id)
    {
        $walikelas = WaliKelas::findOrFail($id);

        return view('admin.walikelas.edit', compact('walikelas'));
    }

    public function walikelasUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:wali_kelas,email,' . $id,
            'kelas_ajar' => 'required|in:10,11,12',
            'password' => 'nullable|min:6',
        ]);
        $walikelas = WaliKelas::findOrFail($id);
        $walikelas->name = $validated['name'];
        $walikelas->email = $validated['email'];
        $walikelas->kelas_ajar = $validated['kelas_ajar'];

        if ($request->filled('password')) {
            $walikelas->password = Hash::make($validated['password']);
        }

        $walikelas->save();

        return redirect()->route('admin.walikelas.index')->with('success', 'Wali Kelas berhasil diperbarui');
    }

    public function walikelasDestroy($id)
    {
        $walikelas = WaliKelas::findOrFail($id);
        $walikelas->delete();

        return redirect()->route('admin.walikelas.index')->with('success', 'Wali Kelas berhasil dihapus');
    }

    // Manajemen Siswa
    public function siswaIndex()
    {
        $siswa = User::with('siswa')
            ->where('role', 'siswa')
            ->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function siswaCreate()
    {
        return view('admin.siswa.create');
    }

    public function siswaStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'nis' => 'required|unique:siswa,nis',
            'kelas' => [
                'required',
                'regex:/^(10|11|12)/', // Kelas harus dimulai dengan 10, 11, atau 12
            ],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'kelas.regex' => 'Format kelas tidak valid. Kelas harus dimulai dengan 10, 11, atau 12'
        ]);

        // Buat user baru
        $userData = array_merge(
            array_intersect_key($validated, array_flip([
                'name', 'email', 'password', 'jenis_kelamin',
                'tempat_lahir', 'tanggal_lahir', 'alamat'
            ])),
            ['role' => 'siswa', 'password' => Hash::make($validated['password'])]
        );

        $user = User::create($userData);

        // Upload foto jika ada
        $foto = null;
        if ($request->hasFile('foto')) {
            $fotoFile = $request->file('foto');
            $foto = time() . '.' . $fotoFile->getClientOriginalExtension();
            $fotoFile->storeAs('public/foto_siswa', $foto);
        }

        // Buat data siswa
        $user->siswa()->create([
            'nis' => $validated['nis'],
            'kelas' => $validated['kelas'],
            'foto' => $foto
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function siswaEdit($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function siswaUpdate(Request $request, $id)
    {
        $user = User::with('siswa')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'nis' => 'required|unique:siswa,nis,' . $user->siswa->id,
            'kelas' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Update user data
        $userData = array_intersect_key($validated, array_flip([
            'name', 'email', 'jenis_kelamin',
            'tempat_lahir', 'tanggal_lahir', 'alamat'
        ]));

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Handle foto upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($user->siswa && $user->siswa->foto) {
                Storage::delete('public/foto_siswa/' . $user->siswa->foto);
            }

            $fotoFile = $request->file('foto');
            $foto = time() . '.' . $fotoFile->getClientOriginalExtension();
            $fotoFile->storeAs('public/foto_siswa', $foto);
            $validated['foto'] = $foto;
        }

        // Update siswa data
        if ($user->siswa) {
            $siswaData = [
                'nis' => $validated['nis'],
                'kelas' => $validated['kelas']
            ];

            if (isset($validated['foto'])) {
                $siswaData['foto'] = $validated['foto'];
            }

            $user->siswa->update($siswaData);
        }

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function siswaDestroy($id)
    {
        $siswa = User::with('siswa')->findOrFail($id);

        // Hapus foto jika ada
        if ($siswa->siswa && $siswa->siswa->foto) {
            Storage::delete('public/foto_siswa/' . $siswa->siswa->foto);
        }

        // Hapus data siswa dan user
        $siswa->siswa()->delete();
        $siswa->delete();

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Siswa berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Manajemen Guru
    public function guruIndex()
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function guruCreate()
    {
        return view('admin.guru.create');
    }

    public function guruStore(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:users',
            'name' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'mata_pelajaran' => 'required',
            'kelas_ajar' => 'required|in:10,11,12',
            'status_guru' => 'required|in:wali_kelas,guru_mapel'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'guru';

        User::create($validated);
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function guruEdit($id)
    {
        $guru = User::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function guruUpdate(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|unique:users,nip,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'mata_pelajaran' => 'required',
            'kelas_ajar' => 'required|in:10,11,12',
            'status_guru' => 'required|in:wali_kelas,guru_mapel'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $guru->update($validated);
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui');
    }

    public function guruDestroy($id)
    {
        $guru = User::findOrFail($id);
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus');
    }

    // Manajemen Wali Kelas
    public function walikelasIndex()
    {
        $walikelas = User::where('status_guru', 'wali_kelas')->get();
        return view('admin.walikelas.index', compact('walikelas'));
    }

    public function walikelasCreate()
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.walikelas.create', compact('guru'));
    }

    public function walikelasStore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas' => 'required'
        ]);

        $guru = User::findOrFail($request->user_id);
        $guru->update([
            'status_guru' => 'wali_kelas',
            'kelas' => $request->kelas
        ]);

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Wali Kelas berhasil ditambahkan');
    }

    public function walikelasEdit($id)
    {
        $walikelas = User::findOrFail($id);
        $guru = User::where('role', 'guru')->get();
        return view('admin.walikelas.edit', compact('walikelas', 'guru'));
    }

    public function walikelasUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas' => 'required'
        ]);

        // Jika mengganti guru, update status guru lama menjadi guru mapel
        $walikelas = User::findOrFail($id);
        if ($walikelas->id != $request->user_id) {
            $walikelas->update([
                'status_guru' => 'guru_mapel',
                'kelas' => null
            ]);

            // Update guru baru menjadi wali kelas
            $guruBaru = User::findOrFail($request->user_id);
            $guruBaru->update([
                'status_guru' => 'wali_kelas',
                'kelas' => $request->kelas
            ]);
        } else {
            // Jika hanya update kelas
            $walikelas->update([
                'kelas' => $request->kelas
            ]);
        }

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Data wali kelas berhasil diperbarui');
    }

    public function walikelasDestroy($id)
    {
        $walikelas = User::findOrFail($id);
        $walikelas->update([
            'status_guru' => 'guru_mapel',
            'kelas' => null
        ]);

        return redirect()->route('admin.walikelas.index')
            ->with('success', 'Wali Kelas berhasil dihapus');
    }

    // Manajemen Siswa
    public function siswaIndex()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function siswaCreate()
    {
        return view('admin.siswa.create');
    }

    public function siswaStore(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:users',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'kelas' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/foto_siswa', $filename);
            $validated['foto'] = $filename;
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'siswa';

        User::create($validated);
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function siswaEdit($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function siswaUpdate(Request $request, $id)
    {
        $siswa = User::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|unique:users,nis,' . $id,
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'kelas' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto) {
                Storage::delete('public/foto_siswa/' . $siswa->foto);
            }

            $foto = $request->file('foto');
            $filename = time() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/foto_siswa', $filename);
            $validated['foto'] = $filename;
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $siswa->update($validated);
        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function siswaDestroy($id)
    {
        $siswa = User::findOrFail($id);
        $siswa->delete();
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nilai;

class GuruController extends Controller
{
    public function dashboard()
    {
        return view('guru.dashboard');
    }

    public function siswa()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('guru.siswa', compact('siswa'));
    }

    public function nilai()
    {
        $nilai = Nilai::with('siswa')->get();
        return view('guru.nilai', compact('nilai'));
    }
}

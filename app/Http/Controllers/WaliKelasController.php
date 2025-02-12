<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nilai;

class WaliKelasController extends Controller
{
    public function dashboard()
    {
        return view('walikelas.dashboard');
    }

    public function rapot()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('walikelas.rapot', compact('siswa'));
    }

    public function leger()
    {
        $nilai = Nilai::with(['siswa', 'mapel'])->get();
        return view('walikelas.leger', compact('nilai'));
    }
}

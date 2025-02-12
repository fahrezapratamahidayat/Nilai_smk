<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class SiswaController extends Controller
{
    public function dashboard()
    {
        return view('siswa.dashboard');
    }

    public function gallery()
    {
        return view('siswa.gallery');
    }

    public function nilai()
    {
        $nilai = Nilai::where('user_id', auth()->id())->get();
        return view('siswa.nilai', compact('nilai'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,guru,walikelas,siswa'
        ]);

        // Cek apakah email dan role sesuai
        $user = User::where('email', $credentials['email'])
                    ->where('role', $credentials['role'])
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email atau role tidak sesuai.',
            ])->withInput($request->except('password'));
        }

        // Coba login
        if (Auth::attempt(['email' => $credentials['email'],
                          'password' => $credentials['password'],
                          'role' => $credentials['role']])) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            switch($credentials['role']) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'walikelas':
                    return redirect()->route('walikelas.dashboard');
                case 'guru':
                    return redirect()->route('guru.dashboard');
                case 'siswa':
                    return redirect()->route('siswa.dashboard');
                default:
                    return redirect('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

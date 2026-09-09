<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
            Auth::logout();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $email = trim($request->email);
        $password = $request->password;

        // Cari data pegawai berdasarkan email
        $pegawai = Pegawai::where('email', $email)->first();

        if (!$pegawai) {
            return back()->withInput($request->only('email'))->with('error', 'Email tidak ditemukan.');
        }

        // Verifikasi password (cocokkan string biasa atau hash bcrypt)
        $passwordMatches = ($pegawai->password === $password) || Hash::check($password, $pegawai->password);

        if (!$passwordMatches) {
            return back()->withInput($request->only('email'))->with('error', 'Password salah. Silakan periksa kembali kata sandi Anda.');
        }

        // Batasi akses: Hanya role admin yang diizinkan masuk ke dashboard saat ini
        if ($pegawai->role !== 'admin') {
            return back()->withInput($request->only('email'))->with('error', 'Akses ditolak! Saat ini dashboard hanya dibuka untuk role Administrator. User/Pegawai mohon menunggu.');
        }

        // Jika password di database masih berupa teks biasa (unhashed dari seeder), otomatis hash ke bcrypt
        if ($pegawai->password === $password) {
            $pegawai->password = Hash::make($password);
            $pegawai->save();
        }

        // Login session
        Auth::login($pegawai, false);
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('sukses', 'Selamat datang kembali, Administrator ' . $pegawai->nama . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('sukses', 'Anda berhasil keluar dari sistem.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class AuthController extends Controller
{
    /**
     * Menampilkan Halaman / Form Login
     *
     * Fungsi ini bertugas untuk menyajikan antarmuka (view) form login kepada pengguna.
     * Alur kerjanya:
     * 1. Mengecek apakah pengguna saat ini sudah memiliki sesi login aktif (Auth::check()).
     * 2. Jika SUDAH login dan memiliki role 'admin', pengguna langsung dialihkan ke dashboard
     *    sehingga tidak perlu login ulang.
     * 3. Jika pengguna yang sedang login bukan admin (misal pegawai biasa), sistem akan
     *    mengeluarkan sesinya terlebih dahulu (Auth::logout()).
     * 4. Jika BELUM login, sistem akan merender tampilan blade `auth.login`.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        // 1. Cek apakah ada session user yang sedang aktif
        if (Auth::check()) {
            // Jika role adalah admin, langsung arahkan ke dashboard
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard');
            }
            // Jika bukan admin, logout sesi sebelumnya
            Auth::logout();
        }

        // 2. Render dan tampilkan view form login
        return view('auth.login');
    }

    /**
     * Memproses Otentikasi dan Autentikasi Pengguna (Login)
     *
     * Fungsi ini menerima input form login via HTTP POST, memvalidasi datanya,
     * mencari akun pegawai di database, memeriksa kecocokan password, memvalidasi hak akses (role),
     * melakukan migrasi otomatis hash password jika diperlukan, serta memulai sesi login.
     *
     * Tahapan Logika di dalamnya:
     * 1. Validasi Input: Memastikan email dan password tidak kosong.
     * 2. Pencarian Data: Mengambil data pegawai dari tabel `pegawais` berdasarkan email.
     * 3. Verifikasi Password: Mendukung password teks biasa (legacy seeder) maupun hash Bcrypt.
     * 4. Otorisasi Role: Membatasi agar hanya akun dengan role 'admin' yang dapat masuk ke dashboard.
     * 5. Auto Hash Upgrade: Mengamankan database dengan mengubah teks password biasa menjadi Bcrypt jika ditemukan.
     * 6. Pembuatan Sesi: Memulai sesi autentikasi Laravel (Auth::login) dan meregenerasi Session ID
     *    guna mencegah serangan Session Fixation.
     *
     * @param  \Illuminate\Http\Request  $request Objek request yang memuat input form login
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // TAHAP 1: Validasi input data dari form
        // Memastikan pengguna telah mengisi kolom email dan password sebelum diproses lebih lanjut
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $email = trim($request->email);
        $password = $request->password;

        // TAHAP 2: Cari record pegawai di database berdasarkan email yang diinput
        $pegawai = Pegawai::where('email', $email)->first();

        // Jika email tidak ditemukan pada database, kembalikan ke form dengan pesan error
        if (!$pegawai) {
            return back()->withInput($request->only('email'))->with('error', 'Email & Password Salah.');
        }

        // TAHAP 3: Verifikasi kecocokan password
        // Mendukung perbandingan string langsung (jika data seeder lama belum di-hash)
        // atau perbandingan algoritma Bcrypt via Hash::check()
        $passwordMatches = ($pegawai->password === $password) || Hash::check($password, $pegawai->password);

        // Jika password tidak cocok, kembalikan ke form dengan pesan error
        if (!$passwordMatches) {
            return back()->withInput($request->only('email'))->with('error', 'Email & Password Salah');
        }

        // TAHAP 4: Pengecekan Hak Akses / Otorisasi Role
        // Memastikan hanya pegawai dengan hak akses 'admin' yang diizinkan masuk ke panel dashboard
        if ($pegawai->role !== 'admin') {
            return back()->withInput($request->only('email'))->with('error', 'Akses ditolak! Saat ini dashboard hanya dibuka untuk role Administrator. User/Pegawai mohon menunggu.');
        }

        // TAHAP 5: Auto-Hashing Password (Peningkatan Keamanan Otomatis)
        // Jika password di tabel masih berbentuk teks polos (unhashed), sistem otomatis meng-enkripsi ke Bcrypt
        if ($pegawai->password === $password) {
            $pegawai->password = Hash::make($password);
            $pegawai->save();
        }

        // TAHAP 6: Daftarkan pengguna ke Sesi Autentikasi Laravel
        // Parameter kedua diset false karena tabel pegawais tidak memiliki kolom remember_token
        Auth::login($pegawai, false);

        // Regenerasi ID sesi untuk mencegah serangan keamanan "Session Fixation Attack"
        $request->session()->regenerate();

        // Redirect pengguna ke halaman dashboard dengan flash message sukses
        return redirect()->route('dashboard')->with('sukses', 'Selamat datang kembali, Administrator ' . $pegawai->nama . '!');
    }

    /**
     * Memproses Logout / Keluar dari Sistem
     *
     * Fungsi ini bertugas membersihkan seluruh sesi pengguna yang aktif saat ini,
     * menghapus data sesi dari penyimpanan server, meregenerasi CSRF token,
     * dan mengembalikan pengguna ke form login.
     *
     * Tahapan Logika:
     * 1. Auth::logout() : Menghapus status autentikasi user dari guard Laravel.
     * 2. $request->session()->invalidate() : Menghancurkan seluruh data sesi dan session ID saat ini.
     * 3. $request->session()->regenerateToken() : Menghasilkan token CSRF baru untuk mencegah eksploitasi CSRF.
     * 4. Redirect pengguna kembali ke route login dengan notifikasi sukses.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // 1. Hapus status login pengguna di Laravel Auth guard
        Auth::logout();

        // 2. Hancurkan sesi pengguna yang aktif agar data tidak dapat disalahgunakan
        $request->session()->invalidate();

        // 3. Buat ulang CSRF token baru untuk keamanan request form berikutnya
        $request->session()->regenerateToken();

        // 4. Arahkan kembali ke halaman login disertai pesan sukses
        return redirect()->route('login')->with('sukses', 'Anda berhasil keluar dari sistem.');
    }
}

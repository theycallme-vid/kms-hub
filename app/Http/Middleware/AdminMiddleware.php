<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Middleware Proteksi Akses Khusus Administrator
     *
     * Middleware ini berfungsi sebagai filter/penjaga gerbang (gatekeeper) untuk
     * seluruh rute di dalam sistem yang memerlukan hak akses Administrator.
     *
     * Logika kerja:
     * 1. Pengecekan Login: Memastikan pengguna sudah memiliki sesi login aktif.
     *    Jika belum login, pengguna akan di-redirect ke halaman login dengan pesan peringatan.
     * 2. Pengecekan Role: Memastikan pengguna yang login memiliki `role === 'admin'`.
     *    Jika bukan admin (misal 'pegawai'), sesi akan dicabut (logout) dan dialihkan kembali
     *    ke halaman login dengan pesan akses ditolak.
     * 3. Jika lolos kedua syarat di atas, request diizinkan lanjut ke controller/tampilan yang dituju.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses dashboard.');
        }

        // 2. Cek apakah role user adalah 'admin'
        if (Auth::user()->role !== 'admin') {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Akses ditolak! Saat ini dashboard hanya dibuka untuk role Administrator.');
        }

        // 3. Lanjutkan request ke halaman yang dituju
        return $next($request);
    }
}

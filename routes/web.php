<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;  
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;

// AUTHENTICATION
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// AREA KHUSUS ADMINISTRATOR
Route::middleware(['admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('layouts.app');
    })->name('dashboard');

    // TABEL BARANG
    Route::get('/barang', function () {
        $barangs = \App\Models\Barang::with('kategori')->get();
        $kategoris = \App\Models\Kategori::all();
        return view('layouts.barang', compact('barangs', 'kategoris'));
    })->name('barang');

    Route::post('/simpan-barang', [BarangController::class, 'simpan'])->name('barang.simpan');
    Route::put('/update-barang', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/hapus-barang/{barang}', [BarangController::class, 'hapus'])->name('barang.hapus');

    // TABEL KATEGORI
    Route::get('/kategori', function () {
        $kategoris = \App\Models\Kategori::all();
        return view('layouts.kategori', compact('kategoris'));
    })->name('kategori');

    Route::post('/simpan-kategori', [KategoriController::class, 'simpan'])->name('kategori.simpan');
    Route::put('/update-kategori', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/hapus-kategori/{kategori}', [KategoriController::class, 'hapus'])->name('kategori.hapus');

    // TABEL PEGAWAI
    Route::get('/pegawai', function () {
        $pegawais = \App\Models\Pegawai::all();
        return view('layouts.pegawai', compact('pegawais'));
    })->name('pegawai');

    Route::post('/simpan-pegawai', [PegawaiController::class, 'simpan'])->name('pegawai.simpan');
    Route::put('/update-pegawai', [PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/hapus-pegawai/{pegawai}', [PegawaiController::class, 'hapus'])->name('pegawai.hapus');

});

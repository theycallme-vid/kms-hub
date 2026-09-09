<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UtamaController;
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

    Route::get('/daftar-barang', [BarangController::class, 'tampil']);
    Route::get('/tambah-barang', [BarangController::class, 'create']);
    Route::post('/simpan-barang', [BarangController::class, 'simpan']);
    Route::delete('/hapus-barang/{barang}', [BarangController::class, 'hapus'])->name('barang.hapus');
    Route::get('/ubah-barang/{barang}', [BarangController::class, 'ubah'])->name('barang.ubah');
    Route::put('/update-barang', [BarangController::class, 'update']);

    // TABEL KATEGORI
    Route::get('/kategori', function () {
        $kategoris = \App\Models\Kategori::all();
        return view('layouts.kategori', compact('kategoris'));
    })->name('kategori');

    Route::get('/daftar-kategori', [KategoriController::class, 'tampil']);
    Route::get('/tambah-kategori', [KategoriController::class, 'create']);
    Route::post('/simpan-kategori', [KategoriController::class, 'simpan']);
    Route::delete('/hapus-kategori/{kategori}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
    Route::get('/ubah-kategori/{kategori}', [KategoriController::class, 'ubah'])->name('kategori.ubah');
    Route::put('/update-kategori', [KategoriController::class, 'update']);

    // TABEL PEGAWAI
    Route::get('/pegawai', function () {
        $pegawais = \App\Models\Pegawai::all();
        return view('layouts.pegawai', compact('pegawais'));
    })->name('pegawai');

    Route::get('/daftar-pegawai', [PegawaiController::class, 'tampil']);
    Route::get('/tambah-pegawai', [PegawaiController::class, 'create']);
    Route::post('/simpan-pegawai', [PegawaiController::class, 'simpan']);
    Route::delete('/hapus-pegawai/{pegawai}', [PegawaiController::class, 'hapus'])->name('pegawai.hapus');
    Route::get('/ubah-pegawai/{pegawai}', [PegawaiController::class, 'ubah'])->name('pegawai.ubah');
    Route::put('/update-pegawai', [PegawaiController::class, 'update']);

});

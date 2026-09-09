<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('layouts.pegawai', compact('pegawais'));
    }

    public function tampil()
    {
        $pegawais = Pegawai::all();
        return view('pegawai.daftar', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'telp'     => 'required|string|max:20',
            'jabatan'  => 'required|string|max:100',
            'email'    => 'required|email|unique:pegawais,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
        ], [
            'nama.required'     => 'Nama pegawai wajib diisi.',
            'telp.required'     => 'Nomor telepon wajib diisi.',
            'jabatan.required'  => 'Jabatan wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email sudah terdaftar untuk pegawai lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
            'role.required'     => 'Role wajib dipilih.',
        ]);

        try {
            $pegawai = new Pegawai;
            $pegawai->nama = $request->get('nama');
            $pegawai->telp = $request->get('telp');
            $pegawai->jabatan = $request->get('jabatan');
            $pegawai->email = $request->get('email');
            $pegawai->password = Hash::make($request->get('password'));
            $pegawai->role = $request->get('role');
            $pegawai->save();

            return redirect('pegawai')->with('sukses', 'Data Pegawai berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect('pegawai')->with('error', 'Gagal menambah data pegawai: ' . $e->getMessage());
        }
    }

    public function hapus(Pegawai $pegawai)
    {
        try {
            $pegawai->delete();
            return redirect('pegawai')->with('sukses', 'Data Pegawai berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('pegawai')->with('error', 'Gagal menghapus data pegawai: ' . $e->getMessage());
        }
    }

    public function ubah(Pegawai $pegawai)
    {
        return view('pegawai.ubah', compact('pegawai'));
    }

    public function update(Request $request)
    {
        $pegawai = Pegawai::find($request->get('id'));

        if (!$pegawai) {
            return redirect('pegawai')->with('error', 'Data Pegawai tidak ditemukan!');
        }

        $request->validate([
            'nama'     => 'required|string|max:255',
            'telp'     => 'required|string|max:20',
            'jabatan'  => 'required|string|max:100',
            'email'    => 'required|email|unique:pegawais,email,' . $pegawai->id,
            'role'     => 'required|in:admin,user',
        ], [
            'nama.required'    => 'Nama pegawai wajib diisi.',
            'telp.required'    => 'Nomor telepon wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.unique'     => 'Email sudah terdaftar untuk pegawai lain.',
            'role.required'    => 'Role wajib dipilih.',
        ]);

        try {
            $pegawai->nama = $request->get('nama');
            $pegawai->telp = $request->get('telp');
            $pegawai->jabatan = $request->get('jabatan');
            $pegawai->email = $request->get('email');
            $pegawai->role = $request->get('role');

            if ($request->filled('password')) {
                $pegawai->password = Hash::make($request->get('password'));
            }

            $pegawai->save();

            return redirect('pegawai')->with('sukses', 'Data Pegawai berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect('pegawai')->with('error', 'Gagal memperbarui data pegawai: ' . $e->getMessage());
        }
    }
}

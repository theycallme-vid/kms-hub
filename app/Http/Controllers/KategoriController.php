<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function simpan(Request $request){
        $request->validate([
            'nama_kategori' => ['required', 'regex:/^[^0-9]+$/'],
            'deskripsi'     => ['nullable'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.regex'    => 'Nama kategori tidak boleh mengandung angka.',
        ]);

        try {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->get('nama_kategori');
            $kategori->deskripsi = $request->get('deskripsi');
            $kategori->save();
            return redirect('kategori')->with('sukses', 'Data Kategori berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect('kategori')->with('error', 'Gagal menambah data kategori: ' . $e->getMessage());
        }
    }

    public function hapus(Kategori $kategori){
        try {
            $kategori->delete();
            return redirect('kategori')->with('sukses', 'Data Kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('kategori')->with('error', 'Gagal menghapus data kategori: ' . $e->getMessage());
        }
    }

    public function update(Request $request) {
        try {
            $kategori = Kategori::find($request->get('id'));
            $kategori->nama_kategori = $request->get('nama_kategori');
            $kategori->deskripsi = $request->get('deskripsi');
            $kategori->save();
            return redirect('kategori')->with('sukses', 'Data Kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect('kategori')->with('error', 'Gagal memperbarui data kategori: ' . $e->getMessage());
        }
    }
}

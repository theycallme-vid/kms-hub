<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kategori extends Model
{
    public $timestamps = false;
    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    /**
     * Relasi ke model Informasi (One to Many)
     * 1 Kategori memiliki banyak Informasi.
     */
    public function informasis()
    {
        return $this->hasMany(Informasi::class, 'kategori_id');
    }
}

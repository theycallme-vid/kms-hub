<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    public $timestamps = false;

    protected $fillable = [
        'tanggal',
        'grandtotal',
        'pegawai_id',
        'pelanggans_id',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggans_id');
    }

    public function detailNotas()
    {
        return $this->hasMany(DetailNota::class, 'notas_id');
    }
}

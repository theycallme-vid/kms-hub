<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'telp',
        'alamat',
    ];

    public function notas()
    {
        return $this->hasMany(Nota::class, 'pelanggans_id');
    }
}

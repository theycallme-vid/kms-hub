<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailNota extends Model
{
    protected $table = 'detailnotas';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'notas_id',
        'barangs_id',
        'qty',
        'subtotal',
    ];

    public function nota()
    {
        return $this->belongsTo(Nota::class, 'notas_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barangs_id');
    }
}

<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pegawais';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'telp',
        'jabatan',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Disable remember_token operations because table does not have remember_token column
     */
    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // No-op
    }

    public function getRememberTokenName()
    {
        return '';
    }

    public function notas()
    {
        return $this->hasMany(Nota::class, 'pegawai_id');
    }
}

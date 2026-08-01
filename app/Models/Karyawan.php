<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'alamat',
        'telepon',
        'jabatan',
    ];

    public function gaji()
    {
        return $this->hasMany(Karyawan::class, 'id_karyawan');
    }

    public function absensi()
    {
        return $this->hasMany(Karyawan::class, 'id_karyawan');
    }
}

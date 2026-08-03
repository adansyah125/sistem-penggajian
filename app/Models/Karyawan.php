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
        'id_jabatan',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function gaji()
    {
        return $this->hasMany(Penggajian::class, 'id_karyawan');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan');
    }
}

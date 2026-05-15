<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'no_rm',
        'nama_pasien',
        'tgl_lahir',
        'jenis_kelamin',
        'no_telepon',
        'pembiayaan',
        'diagnosa_awal',
        'dokter',
        'waktu_daftar',
        'status_rawat_inap',
    ];
}

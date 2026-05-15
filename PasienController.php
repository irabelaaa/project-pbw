<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function store(Request $request)
    {
        Pasien::create([
            'no_rm' => $request->no_rm,
            'nama_pasien' => $request->nama_pasien,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_telepon' => $request->no_telepon,
            'pembiayaan' => $request->pembiayaan,
            'diagnosa_awal' => $request->diagnosa_awal,
            'dokter' => $request->dokter,
            'waktu_daftar' => now(),
            'status_rawat_inap' => 'Belum Dirawat',
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }
}

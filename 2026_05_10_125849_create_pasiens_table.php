<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('pasients', function (Blueprint $table) {
    $table->id();
    $table->string('no_rm');
    $table->string('nama_pasien');
    $table->date('tgl_lahir');
    $table->string('jenis_kelamin');
    $table->string('no_telepon');
    $table->string('pembiayaan');
    $table->text('diagnosa_awal');
    $table->string('dokter');
    $table->string('waktu_daftar');
    $table->string('status_rawat_inap')->default('Belum Dirawat');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};

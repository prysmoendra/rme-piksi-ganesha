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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('id_rekam_medis')->unique(); // Nomor RM (RM-XXXXX)
            $table->string('nama_lengkap');
            $table->string('nik')->unique(); // NIK/BPJS - 16 digits
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('telepon')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->string('kontak_darurat')->nullable();
            $table->enum('jenis_pembayaran', ['Umum', 'BPJS', 'Asuransi Swasta', 'Lainnya'])->default('Umum');
            $table->string('no_surat_jaminan')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('id_rekam_medis');
            $table->index('nik');
            $table->index('nama_lengkap');
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

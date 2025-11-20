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
        Schema::create('inpatient_admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->string('nomor_registrasi_inap')->unique();
            $table->string('kelas'); // Kelas perawatan
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade'); // Dokter penanggung jawab
            $table->date('tanggal_masuk');
            $table->time('waktu_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->string('ruangan_kelas'); // Ruangan/kelas
            $table->string('no_kamar');
            $table->string('diagnosa_awal')->nullable();
            $table->integer('lama_rawat')->nullable(); // Calculated field
            $table->enum('status', ['Active', 'Discharged', 'Transferred'])->default('Active');
            $table->boolean('is_validated')->default(false);
            $table->foreignId('validated_by')->nullable()->constrained('users');
            $table->timestamp('validated_at')->nullable();
            $table->text('validasi_log')->nullable(); // Audit trail
            $table->timestamps();
            
            // Indexes
            $table->index('patient_id');
            $table->index('doctor_id');
            $table->index('nomor_registrasi_inap');
            $table->index('tanggal_masuk');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inpatient_admissions');
    }
};

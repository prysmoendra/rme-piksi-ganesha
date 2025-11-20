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
        Schema::create('clinical_data_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->text('keluhan_utama'); // Chief complaint
            $table->text('riwayat_penyakit_sekarang'); // History of present illness
            $table->text('riwayat_penyakit_dahulu'); // Past medical history
            $table->json('ttv'); // Vital signs: blood pressure, pulse, temperature, respiratory rate
            $table->decimal('tinggi_badan', 5, 2)->nullable(); // Height in cm
            $table->decimal('berat_badan', 5, 2)->nullable(); // Weight in kg
            $table->text('hasil_pemeriksaan_penunjang')->nullable(); // Supporting examination results
            $table->string('diagnosa_kerja')->nullable(); // Working diagnosis (ICD-10)
            $table->string('diagnosa_banding')->nullable(); // Differential diagnosis (ICD-10)
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_data_doctor');
    }
};

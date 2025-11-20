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
        Schema::create('nursing_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->datetime('tanggal_waktu');
            $table->text('tujuan_keperawatan'); // Nursing goals
            $table->text('intervensi_keperawatan'); // Nursing interventions
            $table->string('frekuensi_durasi'); // Frequency & duration (1x/hari, 2x/hari, etc.)
            $table->string('petugas_penanggung_jawab'); // Responsible staff
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('tanggal_waktu');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nursing_notes');
    }
};

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
        Schema::create('medical_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->enum('jenis_tindakan', ['Operasi', 'Pemeriksaan', 'Prosedur', 'Lainnya']); // Type of action
            $table->datetime('tanggal');
            $table->foreignId('dokter_operator_id')->constrained('doctors'); // Operating doctor
            $table->foreignId('perawat_pendamping_id')->constrained('nurses'); // Accompanying nurse
            $table->text('ringkasan_tindakan'); // Action summary
            $table->text('komplikasi')->nullable(); // Complications
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('dokter_operator_id');
            $table->index('perawat_pendamping_id');
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_actions');
    }
};

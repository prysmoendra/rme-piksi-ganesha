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
        Schema::create('doctor_daily_notes_soap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->datetime('tanggal_waktu'); // Current datetime (non-editable)
            $table->text('subjective'); // S - Subjective
            $table->text('objective'); // O - Objective
            $table->text('assessment'); // A - Assessment
            $table->text('plan'); // P - Plan
            $table->string('tanda_tangan_digital')->nullable(); // Digital signature
            $table->foreignId('doctor_id')->constrained('users'); // Associated with logged-in doctor
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('doctor_id');
            $table->index('tanggal_waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_daily_notes_soap');
    }
};

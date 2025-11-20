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
        Schema::create('pharmacy_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->string('nama_obat'); // Medication name
            $table->text('dosis_frekuensi'); // Dosage and frequency
            $table->string('rak_pemberian')->nullable(); // Administration shelf
            $table->time('waktu_pemberian')->nullable(); // Administration time
            $table->enum('status', ['Sudah', 'Belum'])->default('Belum'); // Status
            $table->text('catatan_obat_lanjutan')->nullable(); // Additional medication notes
            $table->string('tanda_tangan_digital')->nullable(); // Digital signature
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('status');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_records');
    }
};

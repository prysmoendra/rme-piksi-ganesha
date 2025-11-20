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
        Schema::create('discharge_resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_pulang'); // Discharge date
            $table->enum('kondisi_saat_pulang', ['Sembuh', 'Membaik', 'Dirujuk', 'Meninggal', 'Lainnya']); // Condition at discharge
            $table->string('diagnosa_akhir'); // Final diagnosis (ICD-10)
            $table->text('terapi_pulang'); // Discharge therapy
            $table->text('tindak_lanjut'); // Follow-up
            $table->text('edukasi_akhir'); // Final education
            $table->string('tanda_tangan_perawat')->nullable(); // Nurse signature
            $table->string('tanda_tangan_dokter')->nullable(); // Doctor signature
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('tanggal_pulang');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discharge_resumes');
    }
};

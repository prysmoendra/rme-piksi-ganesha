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
        Schema::table('clinical_data_doctor', function (Blueprint $table) {
            $table->string('diagnosa_kerja_icd9')->nullable()->after('diagnosa_kerja');
            $table->string('diagnosa_banding_icd9')->nullable()->after('diagnosa_banding');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinical_data_doctor', function (Blueprint $table) {
            $table->dropColumn(['diagnosa_kerja_icd9', 'diagnosa_banding_icd9']);
        });
    }
};

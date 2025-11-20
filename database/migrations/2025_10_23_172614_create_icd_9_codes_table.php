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
        Schema::create('icd_9_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // ICD-9 code (e.g., 001.1)
            $table->text('description'); // Code description
            $table->string('category')->nullable(); // Category grouping
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('code');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icd_9_codes');
    }
};

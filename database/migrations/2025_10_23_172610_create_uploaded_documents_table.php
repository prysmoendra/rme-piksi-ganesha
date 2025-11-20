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
        Schema::create('uploaded_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inpatient_admission_id')->constrained()->onDelete('cascade');
            $table->string('document_type'); // Document type (lab result, x-ray, etc.)
            $table->string('original_name'); // Original file name
            $table->string('file_path'); // Stored file path
            $table->string('file_extension'); // File extension
            $table->integer('file_size'); // File size in bytes
            $table->text('description')->nullable(); // Document description
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
            
            // Indexes
            $table->index('inpatient_admission_id');
            $table->index('document_type');
            $table->index('uploaded_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uploaded_documents');
    }
};

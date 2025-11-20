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
        Schema::create('medication_formulary', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat'); // Medication name
            $table->string('kode_obat')->unique(); // Medication code
            $table->text('deskripsi')->nullable(); // Description
            $table->string('satuan')->nullable(); // Unit (mg, ml, tablet, etc.)
            $table->string('kategori')->nullable(); // Category (antibiotic, analgesic, etc.)
            $table->text('indikasi')->nullable(); // Indication
            $table->text('kontraindikasi')->nullable(); // Contraindication
            $table->decimal('harga', 10, 2)->nullable(); // Price
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('nama_obat');
            $table->index('kode_obat');
            $table->index('kategori');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_formulary');
    }
};

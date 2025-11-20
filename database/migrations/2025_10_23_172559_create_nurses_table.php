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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perawat');
            $table->string('no_sipn')->nullable(); // Surat Izin Praktik Perawat
            $table->string('spesialisasi')->nullable();
            $table->string('shift')->nullable(); // Pagi, Siang, Malam
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('nama_perawat');
            $table->index('spesialisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};

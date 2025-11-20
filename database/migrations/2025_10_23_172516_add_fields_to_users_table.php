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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('employee_id')->unique()->nullable()->after('phone');
            $table->string('department')->nullable()->after('employee_id');
            $table->string('position')->nullable()->after('department');
            $table->boolean('is_active')->default(true)->after('position');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop unique constraint first if it exists
            if (Schema::hasColumn('users', 'employee_id')) {
                try {
                    $table->dropUnique(['employee_id']);
                } catch (\Exception $e) {
                    // Index might not exist, continue
                }
            }
            $table->dropColumn(['phone', 'employee_id', 'department', 'position', 'is_active']);
        });
    }
};

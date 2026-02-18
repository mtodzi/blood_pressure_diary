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
        Schema::table('pressure_measurements', function (Blueprint $table) {
            $table->foreignId('measurement_id')
                ->nullable()
                ->after('user_id')
                ->constrained('measurements')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pressure_measurements', function (Blueprint $table) {
            $table->dropForeign(['measurement_id']);
            $table->dropColumn('measurement_id');
        });
    }
};

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
        Schema::create('keputusan', function (Blueprint $table) {
            $table->id();
            $table->char('kode_gejala');     // FK ke gejala_abk
            $table->char('kode_abk');        // FK ke jenis_abk
            $table->float('mb');             // Nilai MB (Measure of Belief)
            $table->float('md');             // Nilai MD (Measure of Disbelief)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keputusan');
    }
};

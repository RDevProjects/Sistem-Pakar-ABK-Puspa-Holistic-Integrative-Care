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
        Schema::create('gejala_abk', function (Blueprint $table) {
            $table->id();
            $table->char('kode_gejala')->unique(); // Contoh: G01
            $table->string('nama_gejala');         // Contoh: "Kesulitan fokus saat belajar"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gejala');
    }
};

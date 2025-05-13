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
        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->char('diagnosa_id')->unique();    // ID diagnosis, bisa UUID
            $table->json('data_diagnosa');            // Data hasil perhitungan dan hasil akhir
            $table->json('kondisi');                  // Data input user berupa {kode_gejala: kondisi}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosas');
    }
};

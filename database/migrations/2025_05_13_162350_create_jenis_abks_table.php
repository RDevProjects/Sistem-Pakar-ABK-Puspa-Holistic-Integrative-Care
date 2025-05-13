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
        Schema::create('jenis_abk', function (Blueprint $table) {
            $table->id();
            $table->char('kode_abk')->unique(); // Contoh: A01
            $table->string('nama_abk');         // Contoh: "Autisme", "Disleksia"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_abks');
    }
};

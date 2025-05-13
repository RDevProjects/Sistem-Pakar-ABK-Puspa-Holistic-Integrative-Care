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
        Schema::create('kondisi_users', function (Blueprint $table) {
            $table->id();
            $table->string('kondisi');  // Contoh: "Tidak Tahu", "Tidak Yakin", "Mungkin", "Kemungkinan Besar", "Hampir Pasti", "Pasti"
            $table->float('nilai');     // Contoh: 0.0, 0.2, 0.4, 0.6, 0.8, 1.0
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi_users');
    }
};

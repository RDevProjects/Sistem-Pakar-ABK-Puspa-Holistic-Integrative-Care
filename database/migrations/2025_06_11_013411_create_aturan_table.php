<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAturanTable extends Migration
{
    public function up()
    {
        Schema::create('aturan', function (Blueprint $table) {
            $table->id('id_aturan');
            $table->string('kondisi', 100); // e.g., "total_skor >= 8 AND total_skor <= 14"
            $table->string('kategori', 50); // e.g., "Ringan", "Sedang", "Berat"
            $table->string('rekomendasi', 100); // e.g., "Asesmen Lanjutan"
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aturan');
    }
}
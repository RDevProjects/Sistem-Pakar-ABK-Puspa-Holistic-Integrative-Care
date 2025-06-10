<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilObservasiTable extends Migration
{
    public function up()
    {
        Schema::create('hasil_observasi', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->unsignedBigInteger('id_observasi');
            $table->float('total_skor', 5, 2);
            $table->string('kategori', 50);
            $table->string('rekomendasi', 100);
            $table->text('kesimpulan')->nullable();
            $table->timestamps();

            $table->foreign('id_observasi')->references('id_observasi')->on('observasi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hasil_observasi');
    }
}

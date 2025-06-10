<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanObservasiTable extends Migration
{
    public function up()
    {
        Schema::create('jawaban_observasi', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->unsignedBigInteger('id_observasi');
            $table->unsignedBigInteger('id_poin');

            $table->enum('jawaban', ['YA', 'TIDAK'])->default('TIDAK');
            $table->float('mb', 3, 2)->unsigned()->check('mb >= 0 AND mb <= 1');
            $table->float('md', 3, 2)->unsigned()->check('md >= 0 AND md <= 1');
            $table->float('cf', 3, 2)->check('cf >= -1 AND cf <= 1');
            $table->float('skor_hasil', 4, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_observasi')->references('id_observasi')->on('observasi')->onDelete('cascade');
            $table->foreign('id_poin')->references('id_poin')->on('poin_observasi')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('jawaban_observasi');
    }
}
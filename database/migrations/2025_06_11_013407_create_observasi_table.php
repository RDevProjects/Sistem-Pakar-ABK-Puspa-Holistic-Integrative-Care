<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservasiTable extends Migration
{
    public function up()
    {
        Schema::create('observasi', function (Blueprint $table) {
            $table->id('id_observasi');
            $table->string('nama_anak', 100);
            $table->integer('usia')->unsigned()->check('usia >= 2 AND usia <= 5');
            $table->date('tanggal');
            $table->string('koordinator', 100);
            $table->string('observer', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('observasi');
    }
}
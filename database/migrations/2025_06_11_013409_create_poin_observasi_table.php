<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoinObservasiTable extends Migration
{
    public function up()
    {
        Schema::create('poin_observasi', function (Blueprint $table) {
            $table->id('id_poin');
            $table->string('aspek', 50); // e.g., "Perilaku dan Emosi"
            $table->string('deskripsi', 255); // e.g., "Hiperaktif atau bergerak tidak bertujuan"
            $table->integer('skor')->unsigned()->check('skor IN (1, 2, 3)'); // Score: 1, 2, or 3
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poin_observasi');
    }
}

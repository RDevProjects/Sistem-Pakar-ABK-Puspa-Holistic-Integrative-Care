<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('diagnosas', function (Blueprint $table) {
            $table->text('diagnosa_dipilih')->nullable()->after('kondisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('diagnosas', function (Blueprint $table) {
            $table->dropColumn('diagnosa_dipilih');
        });
    }
};

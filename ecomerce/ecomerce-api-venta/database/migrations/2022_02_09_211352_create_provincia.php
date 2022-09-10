<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvincia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provincia', function (Blueprint $table) {
            $table->id('id_provincia');
            $table->string('nombre_provincia');
            $table->unsignedBigInteger('id_pais');
            $table->char('estado_prod',1);
            $table->foreign('id_pais')->references('id_pais')->on('pais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provincia', function (Blueprint $table) {
            //
        });
    }
}

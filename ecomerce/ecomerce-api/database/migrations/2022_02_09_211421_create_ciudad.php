<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudad', function (Blueprint $table) {
            $table->id('id_ciudad');
            $table->string('nombre_ciudad');
            $table->unsignedBigInteger('id_provincia');
            $table->char('estado_ciudad',1);
            $table->foreign('id_provincia')->references('id_provincia')->on('provincia')->onDelete('cascade');
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
        Schema::table('ciudad', function (Blueprint $table) {
            //
        });
    }
}

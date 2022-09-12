<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodega extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodega', function (Blueprint $table) {
            $table->id('id_bod');
            $table->string('nombre_bod');
            $table->char('estado_bod',1);
            $table->string('telef_bod');
            $table->string('cel_bod');
            $table->string('nomb_contac_bod');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('id_ciudad');
            $table->unsignedBigInteger('id_direccion');
            $table->foreign('id_ciudad')->references('id_ciudad')->on('ciudad')->onDelete('cascade');
            $table->foreign('id_direccion')->references('id_direccion')->on('direccion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bodega', function (Blueprint $table) {
            //
        });
    }
}

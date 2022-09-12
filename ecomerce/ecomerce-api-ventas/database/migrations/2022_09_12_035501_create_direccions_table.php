<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->id('id_direccion');
            $table->string('direccion');
            $table->string('calle');
            $table->string('numero');
            $table->string('piso');
            $table->string('telefono');
            $table->string('movil');
            $table->unsignedBigInteger('id_ciudad');
            $table->char('estado_direccion',1);
            $table->foreign('id_ciudad')->references('id_ciudad')->on('ciudad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
};

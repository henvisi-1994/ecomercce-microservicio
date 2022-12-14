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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('tipo_cli');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->char('estado_cli',1);
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_direccion');
            $table->unsignedBigInteger('id_usu');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
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
        Schema::dropIfExists('clientes');
    }
};

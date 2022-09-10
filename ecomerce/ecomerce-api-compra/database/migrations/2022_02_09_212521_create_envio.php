<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('envio', function (Blueprint $table) {
            $table->id('id_envio');
            $table->date('fecha_inicio_ped');
            $table->date('fecha_fin_ped');
            $table->date('fecha_registro_env');
            $table->unsignedBigInteger('ciudad_origen');
            $table->unsignedBigInteger('ciudad_destino');
            $table->unsignedBigInteger('id_pedido');
            $table->foreign('ciudad_origen')->references('id_ciudad')->on('ciudad')->onDelete('cascade');
            $table->foreign('ciudad_destino')->references('id_ciudad')->on('ciudad')->onDelete('cascade');
            $table->foreign('id_pedido')->references('id_pedido')->on('pedido')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('envio', function (Blueprint $table) {
            //
        });
    }
}

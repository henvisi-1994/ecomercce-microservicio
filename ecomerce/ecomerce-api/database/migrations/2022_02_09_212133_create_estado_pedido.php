<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_pedido', function (Blueprint $table) {
            $table->id('id_estado_pedido');
            $table->char('estado_inicial',1);
            $table->char('estado_actual',1);
            $table->char('estado_final',1);
            $table->date('fecha_registro');
            $table->unsignedBigInteger('id_pedido');
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
        Schema::table('estado_pedido', function (Blueprint $table) {
            //
        });
    }
}

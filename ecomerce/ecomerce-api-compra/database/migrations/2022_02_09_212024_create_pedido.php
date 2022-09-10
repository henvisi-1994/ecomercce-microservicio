<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id('id_pedido');
            $table->double('total');
            $table->date('fecha_inicio');
            $table->date('fecha_ult_mod');
            $table->date('fecha_registro_ped');
            $table->char('estado_ped',1);
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('id_formapago');
            $table->foreign('id_cliente')->references('id_cliente')->on('cliente')->onDelete('cascade');
            $table->foreign('id_formapago')->references('id_formapago')->on('forma_pago')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido', function (Blueprint $table) {
            //
        });
    }
}

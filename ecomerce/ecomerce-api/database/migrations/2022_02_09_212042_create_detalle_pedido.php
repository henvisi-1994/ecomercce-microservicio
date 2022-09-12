<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
            $table->id('id_detalle_ped');
            $table->unsignedBigInteger('id_prod');
            $table->unsignedBigInteger('id_pedido');
            $table->integer('cantidad');
            $table->double('total_detalle');
            $table->foreign('id_prod')->references('id_prod')->on('producto')->onDelete('cascade');
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
        Schema::table('detalle_pedido', function (Blueprint $table) {
            //
        });
    }
}

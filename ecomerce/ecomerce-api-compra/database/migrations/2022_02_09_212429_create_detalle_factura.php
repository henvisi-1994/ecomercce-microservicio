<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->id('id_det_fact');
            $table->integer('cantidad');
            $table->text('descripcion');
            $table->double('precio_prod');
            $table->double('descuento');
            $table->double('neto');
            $table->double('iva');
            $table->double('total');
            $table->unsignedBigInteger('id_fact');
            $table->unsignedBigInteger('id_prod');
            $table->foreign('id_fact')->references('id_fact')->on('factura')->onDelete('cascade');
            $table->foreign('id_prod')->references('id_prod')->on('producto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_factura', function (Blueprint $table) {
            //
        });
    }
}

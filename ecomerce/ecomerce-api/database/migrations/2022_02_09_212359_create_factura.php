<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->id('id_fact');
            $table->string('num_fact');
            $table->date('fecha_emision_fact');
            $table->time('hora_emision_fact');
            $table->date('vencimiento_fact');
            $table->text('observ_fact');
            $table->double('subtotal_fact');
            $table->double('subcero_fact');
            $table->double('subiva_fact');
            $table->double('subice_fact');
            $table->double('total_fact');
            $table->unsignedBigInteger('id_formapago');
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
        Schema::table('factura', function (Blueprint $table) {
            //
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id('id_prod');
            $table->string('codigo_prod');
            $table->string('codbarra_prod');
            $table->string('descripcion_prod');
            $table->string('present_prod');
            $table->double('precio_prod');
            $table->integer('stockmin_prod');
            $table->integer('stockmax_prod');
            $table->integer('stock_prod');
            $table->date('fechaing_prod');
            $table->date('fechaelab_prod');
            $table->string('fechacad_prod');
            $table->boolean('aplicaiva_prod');
            $table->boolean('aplicaice_prod');
            $table->double('util_prod');
            $table->double('comision_prod');
            $table->string('imagen_prod');
            $table->string('observ_prod');
            $table->char('estado_prod',1);
            $table->unsignedBigInteger('id_bod');
            $table->unsignedBigInteger('id_marca');
            $table->unsignedBigInteger('id_cat');
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_bod')->references('id_bod')->on('bodega')->onDelete('cascade');
            $table->foreign('id_marca')->references('id_marca')->on('marca')->onDelete('cascade');
            $table->foreign('id_cat')->references('id_cat')->on('categoria')->onDelete('cascade');
            $table->foreign('id_empresa')->references('id_empresa')->on('empresa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('producto', function (Blueprint $table) {
            //
        });
    }
}

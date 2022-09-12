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
        Schema::create('detalle_producto', function (Blueprint $table) {
            $table->id('id_detalle_prod');
            $table->unsignedBigInteger('id_bod');
            $table->unsignedBigInteger('id_prod');
            $table->foreign('id_bod')->references('id_bod')->on('bodega')->onDelete('cascade');
            $table->foreign('id_prod')->references('id_prod')->on('producto')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_producto');
    }
};

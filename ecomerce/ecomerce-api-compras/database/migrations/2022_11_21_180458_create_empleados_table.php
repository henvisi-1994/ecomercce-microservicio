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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->unsignedBigInteger('id_empresa');
            $table->unsignedBigInteger('id_usu');
            $table->unsignedBigInteger('id_cargo');
            $table->unsignedBigInteger('id_persona');
            $table->char('estado_empl',1);
            $table->foreign('id_empresa')->references('id_empresa')->on('empresa')->onDelete('cascade');
            $table->foreign('id_cargo')->references('id_cargo')->on('cargo')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
};

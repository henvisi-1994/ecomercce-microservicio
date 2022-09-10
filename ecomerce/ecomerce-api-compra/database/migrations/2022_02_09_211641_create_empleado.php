<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleado extends Migration
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
            $table->foreign('id_usu')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_cargo')->references('id_cargo')->on('cargo')->onDelete('cascade');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empleado', function (Blueprint $table) {
            //
        });
    }
}

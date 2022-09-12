<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->id('id_persona');
            $table->string('nombre_persona');
            $table->string('apellido_persona');
            $table->string('dni');
            $table->unsignedBigInteger('id_tipo_ident');
            $table->foreign('id_tipo_ident')->references('id_tipo_ident')->on('tipo_identificacion')->onDelete('cascade');
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
        Schema::table('persona', function (Blueprint $table) {
            //
        });
    }
}

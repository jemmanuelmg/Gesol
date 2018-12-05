<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
                  
            $table->increments('res_id');
            $table->string('res_formato', 200);
            $table->date('res_fechaRespuesta', 20);
            $table->string('usu_cedula', 20);

        });

        Schema::table('respuestas', function(Blueprint $table) {
            $table->foreign('usu_cedula')->references('usu_cedula')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('respuestas');
    }
}

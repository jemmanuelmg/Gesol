<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            
            $table->increments('sol_id');
            $table->string('sol_nombre', 50);
            $table->string('sol_formato', 200);
            $table->date('sol_fechaCreacion', 20);
            $table->string('sol_estado', 50)->default('Pendiente');
            $table->string('usu_cedula', 20);
            
        });

        Schema::table('solicitudes', function(Blueprint $table) {
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
        Schema::drop('solicitudes');
    }
}

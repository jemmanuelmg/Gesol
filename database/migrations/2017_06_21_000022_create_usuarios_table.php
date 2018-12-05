<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            
            $table->string('usu_cedula', 20)->unique();
            $table->string('usu_nombres', 50);
            $table->string('usu_apellidos', 50);
            $table->string('usu_genero', 20);
            $table->string('usu_telefono', 20);
            $table->string('usu_correo', 50);
            $table->integer('rol_id')->unsigned();

        });

        Schema::table('usuarios', function(Blueprint $table) {
            $table->foreign('rol_id')->references('rol_id')->on('roles');
        });
           
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}

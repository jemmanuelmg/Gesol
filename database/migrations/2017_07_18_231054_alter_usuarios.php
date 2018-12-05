<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {

            $table->string('usu_password')->default('defecto')->after('usu_correo');
            $table->string('usu_fechaNac')->default('Sin Fecha')->after('usu_genero');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {

            $table->dropColumn('usu_password');
            $table->dropColumn('usu_fechaNac');
            
        });
    }
}

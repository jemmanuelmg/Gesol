<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarOndeleteOnupdateCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('solicitudes', function(Blueprint $table) {
            $table->string('usu_cedula', 20)->onDelete('cascade')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudes', function(Blueprint $table) {
            $table->dropForeign('usu_cedula');
            $table->foreign('usu_cedula')->references('usu_cedula')->on('usuarios');
        });
        

    }
}

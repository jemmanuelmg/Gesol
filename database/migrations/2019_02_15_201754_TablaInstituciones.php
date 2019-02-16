<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaInstituciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituciones', function (Blueprint $table) {
            
            $table->increments('ins_id');
            $table->string('ins_nombre', 50);
            $table->string('ins_tipo', 3); //Bp, Bs, S, Sp,
            $table->string('ins_direccion', 50);
            $table->string('ins_telefono', 15);
            $table->string('ins_email', 50);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('instituciones');
    }
}

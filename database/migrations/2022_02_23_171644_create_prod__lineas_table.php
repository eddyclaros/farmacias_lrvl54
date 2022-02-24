<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdLineasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod__lineas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo',8);
            $table->integer('correlativo')->unsigned();
            $table->string('nombre',200);
            $table->string('descripcion')->nullable();
            $table->tinyInteger('tiempo_demora');
            $table->boolean('activo')->default(1);
            $table->integer('usuario_registro');
            $table->integer('usuario_modifica');
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
        Schema::dropIfExists('prod__lineas');
    }
}

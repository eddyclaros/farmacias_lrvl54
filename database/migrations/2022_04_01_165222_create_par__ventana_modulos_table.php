<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParVentanaModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('par__ventana_modulos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('idmodulo')->unsigned();
            $table->smallInteger('codventana')->unsigned();
            $table->string('nomventana',100);
            $table->string('template');
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idmodulo')->references('id')->on('par__modulos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('par__ventana_modulos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmCodificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alm__codificacions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idsucursal')->unsigned();
            $table->string('letraestante',2);
            $table->tinyInteger('numletra')->unsigned();
            $table->string('codestante',6);
            $table->tinyInteger('numposicion')->unsigned();
            $table->tinyInteger('numaltura')->unsigned();
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idsucursal')->references('id')->on('adm__sucursals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alm__codificacions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaMaestrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_maestros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('num_documento')->unsigned();
            $table->tinyinteger('tipodocumento')->unsigned();
            $table->bigInteger('idcliente');
            $table->decimal('total');
            $table->decimal('efectivo');
            $table->decimal('cambio');
            $table->boolean('activo')->default(1);
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
        Schema::dropIfExists('venta_maestros');
    }
}

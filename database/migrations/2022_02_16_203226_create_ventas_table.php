<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('num_documento')->unsigned();
            $table->tinyinteger('tipodocumento')->unsigned();
            $table->bigInteger('idprestacion')->unsigned();
            $table->bigInteger('iddescuento')->unsigned();
            $table->decimal('monto_cancelado');
            $table->biginteger('idcliente');
            $table->integer('idusuario');
            $table->timestamps();
            $table->foreign('idprestacion')->references('id')->on('prestacions');
            $table->foreign('iddescuento')->references('id')->on('descuentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}

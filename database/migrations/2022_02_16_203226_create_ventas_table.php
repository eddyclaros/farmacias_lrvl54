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
            $table->bigInteger('idprestacion')->unsigned();
            $table->bigInteger('iddescuento')->unsigned()->nullable();
            $table->decimal('monto_cancelado');
            $table->biginteger('idventamaestro')->nullable();
            $table->integer('idusuario');
            $table->tinyInteger('estado')->default(0)->comment('0->en proceso,1->venta correcta,2->venta cancelada eliminada');
            $table->bigInteger('idsucursal');
            $table->timestamps();
            $table->foreign('idprestacion')->references('id')->on('prestacions');
            //$table->foreign('iddescuento')->references('id')->on('descuentos');
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

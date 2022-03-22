<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdSubTipoDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod__sub_tipo_descuentos', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->tinyInteger('idtipodescuento')->unsigned();
            $table->smallInteger('codsubdescuento')->unsigned();
            $table->string('nombre',100);
            $table->string('observaciones',255)->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();

            $table->foreign('idtipodescuento')->references('cod')->on('prod__tipo_descuentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod__sub_tipo_descuentos');
    }
}

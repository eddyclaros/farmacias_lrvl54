<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmSucursalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm__sucursals', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',100);
            $table->string('cod',5);
            $table->smallInteger('correlativo')->unsigned();
            $table->string('razon_social',200);
            $table->string('telefonos',100)->nullable();
            $table->string('nit',50)->nullable();
            $table->string('direccion',250);
            $table->string('ciudad',100);
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
        Schema::dropIfExists('adm__sucursals');
    }
}

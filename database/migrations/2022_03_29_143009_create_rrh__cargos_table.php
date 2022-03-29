<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrh__cargos', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre',50);
            $table->tinyInteger('nivel')->unsigned();
            $table->string('descripcion',255)->nullable();
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
        Schema::dropIfExists('rrh__cargos');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdTipoDescuentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod__tipo_descuentos', function (Blueprint $table) {
            $table->tinyIncrements('id')->unsigned();
            $table->tinyInteger('cod')->unsigned()->unique();
            $table->string('aplica_a',100);
            $table->string('descripcion')->nullable();
            $table->tinyInteger('estado')->default(1)->comment('1->');
            $table->boolean('activo')->default(1);
            $table->string('subcategorias',255);
            $table->timestamps();

           // $table->primary(['cod']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod__tipo_descuentos');
    }
}

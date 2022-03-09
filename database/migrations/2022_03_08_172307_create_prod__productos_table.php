<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProdProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod__productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idlinea')->unsigned();
            $table->string('codigo',15);
            $table->integer('correlativo')->unsigned();
            $table->string('nombre',100);
            $table->bigInteger('iddispenser')->unsigned();
            $table->bigInteger('idcategoria')->unsigned();
            $table->string('cantidad',15);
            $table->bigInteger('idformafarm')->unsigned();
            $table->string('indicaciones')->nullable();
            $table->string('dosificacion')->nullable();
            $table->string('accion_terapeutica')->nullable();
            $table->string('principio_activo')->nullable();
            $table->string('imagen')->nullable();
            $table->tinyInteger('tiempo_pedido');
            $table->decimal('precio_lista');
            $table->decimal('precio_venta');
            $table->string('metodoabc',2);
            $table->tinyInteger('estado')->default(1)->comment('1->');
            $table->boolean('activo')->default(1);
            $table->timestamps();

            $table->foreign('idlinea')->references('id')->on('prod__lineas');
            $table->foreign('iddispenser')->references('id')->on('prod__dispensers');
            $table->foreign('idformafarm')->references('id')->on('prod__forma_farmaceuticas');
            $table->foreign('idcategoria')->references('id')->on('prod__categorias');
            
        });
        //DB::statement("ALTER TABLE prod__productos ADD imagen LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod__productos');
    }
}

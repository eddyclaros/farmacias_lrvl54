<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idarea')->unsigned();
            $table->integer('correlativo')->unsigned();
            $table->string('codigo',3);
            $table->string('nombre',100);
            $table->decimal('precio',8,2);
            $table->string('descripcion',200)->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->foreign('idarea')->references('id')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestacions');
    }
}

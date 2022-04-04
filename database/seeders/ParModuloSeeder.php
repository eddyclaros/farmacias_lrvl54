<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('par__modulos')->insert(['nombre'=>'administración']);
        DB::table('par__modulos')->insert(['nombre'=>'recursos humanos']);
        DB::table('par__modulos')->insert(['nombre'=>'almacenes']);
        DB::table('par__modulos')->insert(['nombre'=>'servicios','contabilizable'=>1]);
        DB::table('par__modulos')->insert(['nombre'=>'configuraciones']);
        DB::table('par__modulos')->insert(['nombre'=>'productos']);
    }
}

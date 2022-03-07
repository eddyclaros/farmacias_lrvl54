<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adm__sucursals')->insert(['tipo'=>'Casa_Matriz','razon_social'=>'ALVARO COCARICO','telefonos'=>'123456','nit'=>'123456','direccion'=>'Santiago II','ciudad'=>'El Alto']);
        DB::table('adm__sucursals')->insert(['tipo'=>'Sucursal 1','razon_social'=>'Sucursal 1','telefonos'=>'123456','nit'=>'123456','direccion'=>'Santiago II','ciudad'=>'El Alto']);
    }
}

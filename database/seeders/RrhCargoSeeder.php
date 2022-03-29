<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adm_Sucursal;

class RrhCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rrh__cargos')->insert(['nombre'=>'Admin','nivel'=>1]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Gerente General','nivel'=>1]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Asesor Jurídico','nivel'=>3]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Auditor','nivel'=>3]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Contador General','nivel'=>3]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Responsable de Activos Fijos','nivel'=>2]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Responsable de Almacenes','nivel'=>2]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Responsable de Archivo','nivel'=>2]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Responsable de Recursos Humanos','nivel'=>2]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Responsable de Sistemas','nivel'=>2]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Auxiliar Contable','nivel'=>3]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Analista Desarrollador','nivel'=>3]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Secretaria','nivel'=>3]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Auxiliar de Farmacia','nivel'=>4]);
        DB::table('rrh__cargos')->insert(['nombre'=>'Regente Farmaceutica','nivel'=>4]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Rrh_Cargo;
use App\Rrh_Formacion;
use App\Rrh_Profesion;
use App\Adm_Sucursal;

class RrhEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo = Rrh_Cargo::where('nombre', 'Admin')->first();        
        $formacion = Rrh_Formacion::where('nombre', 'Titulado Universitario')->first();        
        $profecion = Rrh_Profesion::where('nombre', 'Ingeniero de Sistemas')->first();        
        $sucursal = Adm_Sucursal::where('cod', 'SU001')->first();        

        DB::table('rrh__empleados')->insert(['codempleado'=>'ADMIN','nombre'=>'ADMIN','sexo'=>'M','idcargo'=>$cargo->id,'idformacion'=>$formacion->id,'idprofesion'=>$profecion->id,'idsucursal'=>$sucursal->id]);
    }
}

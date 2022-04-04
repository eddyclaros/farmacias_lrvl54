<?php

namespace Database\Seeders;

use App\Par_Modulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParVentanaModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Par_Modulo::where('nombre', 'administración')->first();        
        $rh = Par_Modulo::where('nombre', 'recursos humanos')->first();        
        $alm = Par_Modulo::where('nombre', 'almacenes')->first();        
        $serv = Par_Modulo::where('nombre', 'servicios')->first();        
        $config = Par_Modulo::where('nombre', 'configuraciones')->first();        
        $prod = Par_Modulo::where('nombre', 'productos')->first();        

        
        
        //administracion 100

        DB::table('par__ventana_modulos')->insert(['codventana'=>'101','idmodulo'=>$admin->id,'nomventana'=>'Sucursales','template'=>'sucursal-component']);
        //DB::table('par__ventana_modulos')->insert(['codventana'=>'102','idmodulo'=>$admin->id,'nomventana'=>'Cargos','template'=>'cargos-component']);
        //recursos humanos 200
        DB::table('par__ventana_modulos')->insert(['codventana'=>'201','idmodulo'=>$rh->id,'nomventana'=>'Configuraciones','template'=>'rrhconf-component']);

        //almacenes 300

        DB::table('par__ventana_modulos')->insert(['codventana'=>'301','idmodulo'=>$alm->id,'nomventana'=>'Codificacion','template'=>'codificacion-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'302','idmodulo'=>$alm->id,'nomventana'=>'Ingreso Productos','template'=>'almacen-component']);
        

        //servicios 400
        DB::table('par__ventana_modulos')->insert(['codventana'=>'401','idmodulo'=>$serv->id,'nomventana'=>'Areas','template'=>'area-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'402','idmodulo'=>$serv->id,'nomventana'=>'Prestaciones','template'=>'prestaciones-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'403','idmodulo'=>$serv->id,'nomventana'=>'Venta Servicios','template'=>'ventas-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'404','idmodulo'=>$serv->id,'nomventana'=>'Historial Ventas','template'=>'histventas-component']);


        //configuraciones 500
        DB::table('par__ventana_modulos')->insert(['codventana'=>'501','idmodulo'=>$config->id,'nomventana'=>'Desc. Servicios','template'=>'descuentos-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'502','idmodulo'=>$config->id,'nomventana'=>'Desc. Productos','template'=>'descproductos-component']);


        //productos 600
        DB::table('par__ventana_modulos')->insert(['codventana'=>'601','idmodulo'=>$prod->id,'nomventana'=>'Lineas','template'=>'linea-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'602','idmodulo'=>$prod->id,'nomventana'=>'Registro Producto','template'=>'producto-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'603','idmodulo'=>$prod->id,'nomventana'=>'Dispenser','template'=>'dispenser-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'604','idmodulo'=>$prod->id,'nomventana'=>'Forma Farmaceutica','template'=>'formafarm-component']);
        DB::table('par__ventana_modulos')->insert(['codventana'=>'605','idmodulo'=>$prod->id,'nomventana'=>'Categorias','template'=>'categoria-component']);
    }
}

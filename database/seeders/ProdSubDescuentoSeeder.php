<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdSubDescuentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>1,'codsubdescuento'=>101,'nombre'=>'Metodo ABC','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>1,'codsubdescuento'=>102,'nombre'=>'Producto Individual','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>1,'codsubdescuento'=>103,'nombre'=>'Categoria','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>2,'codsubdescuento'=>201,'nombre'=>'Monto mayor A','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>2,'codsubdescuento'=>202,'nombre'=>'Cantidad de Compras','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>3,'codsubdescuento'=>301,'nombre'=>'Semana','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>3,'codsubdescuento'=>302,'nombre'=>'Rango de Fechas','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>3,'codsubdescuento'=>303,'nombre'=>'Fecha X','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>4,'codsubdescuento'=>401,'nombre'=>'Efectivo','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>4,'codsubdescuento'=>402,'nombre'=>'Tarjeta','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__sub_tipo_descuentos')->insert(['idtipodescuento'=>4,'codsubdescuento'=>403,'nombre'=>'Transferencia','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);

    }
}

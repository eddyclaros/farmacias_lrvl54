<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prod__lineas')->insert(['codigo'=>'P1001','correlativo'=>1,'nombre'=>'Delta','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1002','correlativo'=>2,'nombre'=>'Hidrofilo Bolivia','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1003','correlativo'=>3,'nombre'=>'Rossetti Insumos','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1004','correlativo'=>4,'nombre'=>'Cofar','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1005','correlativo'=>5,'nombre'=>'Breskot Pharma','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1006','correlativo'=>6,'nombre'=>'Vidiline','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1007','correlativo'=>7,'nombre'=>'Prodexa','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1008','correlativo'=>8,'nombre'=>'IFA','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1009','correlativo'=>9,'nombre'=>'Bago','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1010','correlativo'=>10,'nombre'=>'Protein','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1011','correlativo'=>11,'nombre'=>'Mead johnson','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1012','correlativo'=>12,'nombre'=>'Leti','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1013','correlativo'=>13,'nombre'=>'Octapharma','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1014','correlativo'=>14,'nombre'=>'Biopropharma Oncologia','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'P1015','correlativo'=>15,'nombre'=>'IFC Cantabria','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);

    }
}

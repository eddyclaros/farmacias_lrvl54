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
        DB::table('prod__lineas')->insert(['codigo'=>'10001','correlativo'=>1,'nombre'=>'Delta','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10002','correlativo'=>2,'nombre'=>'Hidrofilo Bolivia','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10003','correlativo'=>3,'nombre'=>'Rossetti Insumos','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10004','correlativo'=>4,'nombre'=>'Cofar','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10005','correlativo'=>5,'nombre'=>'Breskot Pharma','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10006','correlativo'=>6,'nombre'=>'Vidiline','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10007','correlativo'=>7,'nombre'=>'Prodexa','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10008','correlativo'=>8,'nombre'=>'IFA','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10009','correlativo'=>9,'nombre'=>'Bago','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10010','correlativo'=>10,'nombre'=>'Protein','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10011','correlativo'=>11,'nombre'=>'Mead johnson','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10012','correlativo'=>12,'nombre'=>'Leti','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10013','correlativo'=>13,'nombre'=>'Octapharma','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10014','correlativo'=>14,'nombre'=>'Biopropharma Oncologia','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__lineas')->insert(['codigo'=>'10015','correlativo'=>15,'nombre'=>'IFC Cantabria','tiempo_demora'=>7,'usuario_registro'=>1,'usuario_modifica'=>1,'created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);

    }
}

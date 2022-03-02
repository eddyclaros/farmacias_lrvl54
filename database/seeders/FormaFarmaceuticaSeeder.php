<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FormaFarmaceuticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'comprimidos','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'capsulas','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'sobres','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'comprimidos masticables','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'barras','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'tabletas vaginales','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'jarabe','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'suspencion oral','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'gotas orales','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'antiseptico topico','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'crema dermica','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'pomada dermica','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'unguento dermico','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'supositorio','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'pieza','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'ampollas','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'gotas oftalmicas','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'gel dermico','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'elixir','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
        DB::table('prod__forma_farmaceuticas')->insert(['nombre'=>'pasta dermica','created_at'=>date("Y/m/d H:i:s"),'updated_at'=>date("Y/m/d H:i:s")]);
    }
}

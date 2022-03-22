<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()    
    {
        $this->truncateTables([
            'prod__dispensers',
            'prod__forma_farmaceuticas',
            'prod__lineas',
            'adm__sucursals',
            'prod__categorias',
            'prod__tipo_descuentos',
            'prod__sub_tipo_descuentos'
        ]);
        $this->call(DispenserSeeder::class);
        $this->call(FormaFarmaceuticaSeeder::class);
        $this->call(LineaSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(ProdCategoriasSeeder::class);
        $this->call(TipoDescuentoSeeder::class);
        $this->call(ProdSubDescuentoSeeder::class);
    }
    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS =0');

        foreach($tables as $table)
        {
            DB::table($table)->truncate(); // para vaciar la tabla
        }
    }
}

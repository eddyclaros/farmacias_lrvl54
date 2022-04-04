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
            'rrh__cargos',
            'rrh__formacions',
            'rrh__profesions',
            'rrh__empleados',
            'users',
            'par__modulos',
            'par__ventana_modulos',
        ]);
        $this->call(DispenserSeeder::class);
        $this->call(FormaFarmaceuticaSeeder::class);
        $this->call(LineaSeeder::class);
        $this->call(SucursalSeeder::class);
        $this->call(ProdCategoriasSeeder::class);
        $this->call(TipoDescuentoSeeder::class);
        $this->call(RrhCargoSeeder::class);
        $this->call(RrhFormacionSeeder::class);
        $this->call(RrhProfesionSeeder::class);
        $this->call(RrhEmpleadoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ParModuloSeeder::class);
        $this->call(ParVentanaModuloSeeder::class);

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

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Rrh_Empleado;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empleado = Rrh_Empleado::where('codempleado', 'ADMIN')->first();        

        $user = new User();
        $user->username = 'user';  //es el admin
        $user->idempleado = $empleado->id;
        $user->email = 'user@example.com';
        $user->password = bcrypt('secret');
        $user->save();
    }
}

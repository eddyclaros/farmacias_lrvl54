<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = DB::connection('farma')->table('persona')->where('tipo_persona','CLIENTE')->get();
        return $clientes;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;

class ClientesController extends Controller
{
    public function index()
    {
        /* $clientes = DB::connection('farma')->table('persona')->where('tipo_persona','CLIENTE')->get();
        return $clientes; */
    }
    public function selectClientes(Request $request)  //AjaxSelect
    {
        $buscararray = array(); 
        if(!empty($request->buscar)) $buscararray = explode(" ",$request->buscar); 
        $raw=DB::raw(DB::raw('concat(apaterno," ",amaterno," ",nombre) as nom'));
        if (sizeof($buscararray)>0) { 
            $sqls=''; 
            foreach($buscararray as $valor){
                if(empty($sqls))
                    $sqls="(apaterno like '%".$valor."%' or amaterno like '%".$valor."%' or nombre like '%".$valor."%' )";
                else
                    $sqls.=" and (apaterno like '%".$valor."%' or amaterno like '%".$valor."%' or nombre like '%".$valor."%' )";
            }   
            $clientes = Cliente::select($raw,'id','nombre')
                                ->where('activo',1)
                                ->whereraw($sqls)
                                ->orderby('apaterno','asc')
                                ->orderby('amaterno','asc')
                                ->orderby('nombre','asc')
                                ->get();
        }
        else {
            if ($request->id){
                    $clientes = Cliente::select($raw,'id','nombre')
                                                 ->where('activo',1)
                                                ->where('id',$request->id)
                                                ->orderby('apaterno','asc')
                                                ->orderby('amaterno','asc')
                                                ->orderby('nombre','asc')
                                                ->get();
            }

            else
            {
                $clientes = Cliente::select($raw,'id','nombre')
                                    ->where('activo',1)
                                    ->orderby('apaterno','asc')
                                    ->orderby('amaterno','asc')
                                    ->orderby('nombre','asc')
                                    ->get();
            }
              
        }
        return ['clientes' => $clientes];
    }
}

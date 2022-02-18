<?php

namespace App\Http\Controllers;

use App\VentaMaestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaMaestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscararray=array();
        $fechainicio = date("Y-m-d", strtotime($request->fechainicio));
        $fechafin=date("Y-m-d",strtotime($request->fechafin));
        $raw=DB::raw(DB::raw('concat(apaterno," ",amaterno," ",nombre) as nombres'));
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(apaterno like '%".$valor."%' or amaterno like '%".$valor."%' or nombre like '%".$valor."%' )";
                    }
                    else
                    {
                        $sqls.=" and (apaterno like '%".$valor."%' or amaterno like '%".$valor."%' or nombre like '%".$valor."%' )";
                    }
    
                }
                $ventamaestro= VentaMaestro::join('clientes','clientes.id','venta_maestros.idcliente')
                                            ->select($raw,
                                                    'venta_maestros.id as id',
                                                    'total',
                                                    'efectivo',
                                                    'cambio',
                                                    'venta_maestros.created_at',
                                                    'venta_maestros.activo')
                                            ->orderby('venta_maestros.created_at','desc')
                                            ->whereraw($sqls)
                                            ->where('venta_maestros.activo',1)
                                            ->whereBetween(DB::raw('date(venta_maestros.created_at)'), [$fechainicio, $fechafin])
                                            ->paginate(20);
                
            }
        }
        
        else
        {
            $ventamaestro= VentaMaestro::join('clientes','clientes.id','venta_maestros.idcliente')
                                        ->select($raw,
                                                'venta_maestros.id as id',
                                                'total',
                                                'efectivo',
                                                'cambio',
                                                'venta_maestros.created_at',
                                                'venta_maestros.activo')
                                                ->orderby('venta_maestros.created_at','desc')
                                                ->where('venta_maestros.activo',1)
                                                ->whereBetween(DB::raw('date(venta_maestros.created_at)'), [$fechainicio, $fechafin])
                                        ->paginate(20);
        }
        
        //$ventamaestro = VentaMaestro::all();
        $sumatotal=0;
        foreach ($ventamaestro as $key => $value) {
            $sumatotal=$sumatotal+$value->total;
        }
        return ['pagination'=>[
                                'total'         =>    $ventamaestro->total(),
                                'current_page'  =>    $ventamaestro->currentPage(),
                                'per_page'      =>    $ventamaestro->perPage(),
                                'last_page'     =>    $ventamaestro->lastPage(),
                                'from'          =>    $ventamaestro->firstItem(),
                                'to'            =>    $ventamaestro->lastItem(),

                                ] ,
                'ventamaestro'=>$ventamaestro,
                'sumatotal'=>$sumatotal
            ];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $ventamaestro = new VentaMaestro();

        $ventamaestro->num_documento=1;
        $ventamaestro->tipodocumento=1;
        $ventamaestro->idcliente=$request->idcliente;
        $ventamaestro->total=$request->total;
        $ventamaestro->efectivo=$request->efectivo;
        $ventamaestro->cambio=$request->cambio;
        /* $ventamaestro->idusuario=1;
        $ventamaestro->idsucursal=1; */
        $ventamaestro->save();
        $id=$ventamaestro->id;
        
        DB::table('ventas')
            ->where('estado', 0)
            ->update(['estado' => 1,
                        'idventamaestro'=>$id]);
        return 'correcto';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function show(VentaMaestro $ventaMaestro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function edit(VentaMaestro $ventaMaestro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaMaestro $ventaMaestro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaMaestro $ventaMaestro)
    {
        //
    }
    public function registrarVentaMaestro()
    {
        //$venta=Venta::
        DB::table('ventas')
                ->where('estado', 0)
                ->update(['estado' => 1]);
    }
    public function desactivar(Request $request)
    {
        $ventamaestro = VentaMaestro::findOrFail($request->id);
        $ventamaestro->activo=0;
        $ventamaestro->save();
    }

    public function activar(Request $request)
    {
        $ventamaestro = VentaMaestro::findOrFail($request->id);
        $ventamaestro->activo=1;
        $ventamaestro->save();
    }
}

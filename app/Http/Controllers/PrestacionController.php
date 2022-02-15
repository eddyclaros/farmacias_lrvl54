<?php

namespace App\Http\Controllers;

use App\Prestacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(codigo like '%".$valor."%' or nombre like '%".$valor."%' or precio like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (codigo like '%".$valor."%' or nombre like '%".$valor."%' or precio like '%".$valor."%')" ;
                    }
    
                }
                $prestaciones= Prestacion::orderby('codigo','asc')
                                            ->whereraw($sqls)
                                            ->where('idarea',$request->idarea)
                                            ->paginate(20);
            }
        }
        
        else
        {
            $prestaciones= Prestacion::orderby('codigo','asc')
                                        ->where('idarea',$request->idarea)
                                        ->paginate(20);
        }
        
        //$prestaciones = Prestacion::all();
        
        $maxcorrelativo = Prestacion::select(DB::raw('max(correlativo) as maximo'))
                                        ->where('idarea',$request->idarea)
                                        ->get();
        return ['pagination'=>[
            'total'         =>    $prestaciones->total(),
            'current_page'  =>    $prestaciones->currentPage(),
            'per_page'      =>    $prestaciones->perPage(),
            'last_page'     =>    $prestaciones->lastPage(),
            'from'          =>    $prestaciones->firstItem(),
            'to'            =>    $prestaciones->lastItem(),

        ] ,
                'prestaciones'=>$prestaciones, 
                'maxcorrelativo'=>$maxcorrelativo
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
        $prestacion = new Prestacion();

        $prestacion->idarea=$request->idarea;
        $prestacion->nombre=$request->nombre;
        $prestacion->precio=$request->precio;
        $prestacion->descripcion=$request->descripcion;
        $prestacion->codigo=$request->codigo;
        $prestacion->correlativo=$request->correlativo;
        $prestacion->save();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prestacion  $prestacion
     * @return \Illuminate\Http\Response
     */
    public function show(Prestacion $prestacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prestacion  $prestacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestacion $prestacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prestacion  $prestacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $prestacion = Prestacion::findOrFail($request->id);

        $prestacion->nombre=$request->nombre;
        $prestacion->precio=$request->precio;
        $prestacion->descripcion=$request->descripcion;
        $prestacion->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestacion  $prestacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestacion $prestacion)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $prestacion = Prestacion::findOrFail($request->id);
        $prestacion->activo=0;
        $prestacion->save();
    }

    public function activar(Request $request)
    {
        $prestacion = Prestacion::findOrFail($request->id);
        $prestacion->activo=1;
        $prestacion->save();
    }
}

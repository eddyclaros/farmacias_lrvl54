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
                        $sqls="(areas.codigo like '%".$valor."%' or areas.nombre like '%".$valor."%' or prestacions.codigo like '%".$valor."%' or prestacions.nombre like '%".$valor."%' or precio like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (areas.codigo like '%".$valor."%' or areas.nombre like '%".$valor."%' or prestacions.codigo like '%".$valor."%' or prestacions.nombre like '%".$valor."%' or precio like '%".$valor."%')" ;
                    }
    
                }
                $prestaciones= Prestacion::join('areas','areas.id','prestacions.idarea')
                                        ->select('areas.nombre as nomarea',
                                                'areas.codigo as codarea',
                                                'prestacions.codigo as codigo',
                                                'prestacions.id as id',
                                                'prestacions.nombre as nombre',
                                                'precio',
                                                'prestacions.descripcion',
                                                'prestacions.activo'
                                                )
                                                ->orderby('areas.codigo','asc')
                                                ->orderby('prestacions.codigo','asc')
                                            ->whereraw($sqls)
                                            ->where('prestacions.activo',1)
                                            ->paginate(20);
            }
        }
        
        else
        {
            $prestaciones= Prestacion::join('areas','areas.id','prestacions.idarea')
                                        ->select('areas.nombre as nomarea',
                                                 'areas.codigo as codarea',
                                                'prestacions.codigo as codigo',
                                                'prestacions.id as id',
                                                'prestacions.nombre as nombre',
                                                'precio',
                                                'prestacions.descripcion',
                                                'prestacions.activo'
                                                )
                                        ->orderby('areas.codigo','asc')
                                        ->orderby('prestacions.codigo','asc')
                                        ->where('prestacions.activo',1)
                                        ->paginate(20);
        }
        
        //$prestaciones = Prestacion::all();
        
        
        return ['pagination'=>[
            'total'         =>    $prestaciones->total(),
            'current_page'  =>    $prestaciones->currentPage(),
            'per_page'      =>    $prestaciones->perPage(),
            'last_page'     =>    $prestaciones->lastPage(),
            'from'          =>    $prestaciones->firstItem(),
            'to'            =>    $prestaciones->lastItem(),

        ] ,
                'prestaciones'=>$prestaciones, 
                
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
        
        $maxcorrelativo = Prestacion::select(DB::raw('max(correlativo) as maximo'))
                                        ->where('idarea',$request->idarea)
                                        ->get()->toArray();
        
        $correlativo=$maxcorrelativo[0]['maximo'];

        if(is_null($correlativo))
            $correlativo=1;
        else
            $correlativo=$correlativo+1;

        if($correlativo<10)
            $codigo='00'.$correlativo;
        else
            if($correlativo<100)
                $codigo='0'.$correlativo;

        $prestacion = new Prestacion();

        $prestacion->idarea=$request->idarea;
        $prestacion->nombre=$request->nombre;
        $prestacion->precio=$request->precio;
        $prestacion->descripcion=$request->descripcion;
        $prestacion->codigo=$codigo;
        $prestacion->correlativo=$correlativo;
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
    public function selectPrestacion()
    {
        $prestaciones=Prestacion::join('areas','areas.id','prestacions.idarea')
                                ->select(DB::raw('concat(areas.codigo,prestacions.codigo) as cod'),
                                        'prestacions.nombre',
                                        'prestacions.id',
                                        'prestacions.precio')
                                ->where('areas.activo',1)
                                ->where('prestacions.activo',1)
                                ->orderby('prestacions.nombre','asc')
                                ->get();
        return $prestaciones;
    }
    public function selectPrestaciones(Request $request)  //AjaxSelect
    {
        $buscararray = array(); 
        if(!empty($request->buscar)) $buscararray = explode(" ",$request->buscar); 
        $raw=DB::raw(DB::raw('concat(areas.codigo,prestacions.codigo," ",prestacions.nombre) as cod'));
        if (sizeof($buscararray)>0) { 
            $sqls=''; 
            foreach($buscararray as $valor){
                if(empty($sqls))
                    $sqls="(areas.codigo like '%".$valor."%' or prestacions.codigo like '%".$valor."%' or prestacions.nombre like '%".$valor."%' )";
                else
                    $sqls.=" and (areas.codigo like '%".$valor."%' or prestacions.codigo like '%".$valor."%' or prestacions.nombre like '%".$valor."%')";
            }   
            $prestaciones = Prestacion::join('areas','areas.id','prestacions.idarea')
                                            ->select($raw,
                                                    'prestacions.nombre',
                                                    'prestacions.id',
                                                    'prestacions.precio')
                                            ->where('areas.activo',1)
                                            ->where('prestacions.activo',1)
                                            ->whereraw($sqls)
                                            ->orderby('prestacions.codigo','asc')
                                            ->get();
        }
        else {
            if ($request->id){
                    $prestaciones = Prestacion::join('areas','areas.id','prestacions.idarea')
                                                ->select($raw,
                                                        'prestacions.nombre',
                                                        'prestacions.id',
                                                        'prestacions.precio')
                                                ->where('areas.activo',1)
                                                ->where('prestacions.activo',1)
                                                ->where('prestacions.id',$request->id)
                                                ->orderby('prestacions.codigo','asc')
                                                ->get();
            }

            else
            {
                $prestaciones = Prestacion::join('areas','areas.id','prestacions.idarea')
                ->select($raw,
                        'prestacions.nombre',
                        'prestacions.id',
                        'prestacions.precio')
                ->where('areas.activo',1)
                ->where('prestacions.activo',1)
                ->orderby('prestacions.codigo','asc')
                ->get();
            }
              
        }
        return ['prestaciones' => $prestaciones];
    }
}

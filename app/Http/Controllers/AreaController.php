<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Area;
use Illuminate\Support\Facades\DB;


class AreaController extends Controller
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
                        $sqls="(codigo like '%".$valor."%' or nombre like '%".$valor."%' or descripcion like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (codigo like '%".$valor."%' or nombre like '%".$valor."%' or descripcion like '%".$valor."%')" ;
                    }
    
                }
                $areas= Area::orderby('codigo','asc')->whereraw($sqls)->paginate(10);
            }
        }
        
        else
        {
            $areas= Area::orderby('codigo','asc')->paginate(10);
        }
        
        //$areas = Area::all();
        
        $maxcorrelativo = Area::select(DB::raw('max(correlativo) as maximo'))
                                ->get();
        return ['pagination'=>[
            'total'         =>    $areas->total(),
            'current_page'  =>    $areas->currentPage(),
            'per_page'      =>    $areas->perPage(),
            'last_page'     =>    $areas->lastPage(),
            'from'          =>    $areas->firstItem(),
            'to'            =>    $areas->lastItem(),

        ] ,
                'areas'=>$areas,
                'maxcorrelativo'=>$maxcorrelativo];
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $area = new Area();

        $area->nombre=$request->nombre;
        $area->descripcion=$request->descripcion;
        $area->codigo=$request->codigo;
        $area->correlativo=$request->correlativo;
        $area->save();
    }

   

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $area = Area::findOrFail($request->id);

        $area->nombre=$request->nombre;
        $area->descripcion=$request->descripcion;
        $area->save();
    }

    public function desactivar(Request $request)
    {
        $area = Area::findOrFail($request->id);
        $area->activo=0;
        $area->save();
    }

    public function activar(Request $request)
    {
        $area = Area::findOrFail($request->id);
        $area->activo=1;
        $area->save();
    }
    public function selectArea()
    {
        $areas=Area::select(DB::raw('concat(codigo, " - ",nombre) as area'),
                            'id')
                    ->where('activo',1)
                    ->orderby('codigo','asc')
                    ->get();
        return $areas;
        

    }
   
}

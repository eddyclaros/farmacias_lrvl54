<?php

namespace App\Http\Controllers;

use App\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DescuentoController extends Controller
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
                        $sqls="(monto like '%".$valor."%' or nombre like '%".$valor."%' or descripcion like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (monto like '%".$valor."%' or nombre like '%".$valor."%' or descripcion like '%".$valor."%')" ;
                    }
    
                }
                $descuentos= Descuento::orderby('nombre','asc')->whereraw($sqls)->paginate(20);
            }
        }
        
        else
        {
            $descuentos= Descuento::orderby('nombre','asc')->paginate(20);
        }
        
        //$areas = Descuento::all();
        
        return ['pagination'=>[
            'total'         =>    $descuentos->total(),
            'current_page'  =>    $descuentos->currentPage(),
            'per_page'      =>    $descuentos->perPage(),
            'last_page'     =>    $descuentos->lastPage(),
            'from'          =>    $descuentos->firstItem(),
            'to'            =>    $descuentos->lastItem(),

        ] ,
                'descuentos'=>$descuentos];
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
        $descuento = new Descuento();

        $descuento->nombre=$request->nombre;
        $descuento->descripcion=$request->descripcion;
        $descuento->monto=$request->monto;
        $descuento->siporcentaje=$request->siporcentaje;
        $descuento->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function show(Descuento $descuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function edit(Descuento $descuento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $descuento = Descuento::findOrFail($request->id);

        $descuento->nombre=$request->nombre;
        $descuento->descripcion=$request->descripcion;
        $descuento->monto=$request->monto;
        $descuento->siporcentaje=$request->siporcentaje;
        $descuento->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Descuento $descuento)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $descuento = Descuento::findOrFail($request->id);
        $descuento->activo=0;
        $descuento->save();
    }

    public function activar(Request $request)
    {
        $descuento = Descuento::findOrFail($request->id);
        $descuento->activo=1;
        $descuento->save();
    }
    public function selectDescuento()
    {
        $descuentos=Descuento::select('id',DB::raw('concat(nombre, "-",monto,IF(siporcentaje=1, "%", "Bs.")) as nombre'),'monto','siporcentaje')
                    ->where('activo',1)
                    ->orderby('siporcentaje','desc')
                    ->orderby('monto','desc')
                    ->get();
        return $descuentos;
        

    }
    public function obtenerFecha()
    {
        
        
        return  DB::select('select curdate() as fecha');     
        

    }
}

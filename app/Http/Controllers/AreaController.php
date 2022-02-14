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
    public function index()
    {
        $areas = Area::all();
        $maxcorrelativo = Area::select(DB::raw('max(correlativo) as maximo'))
                                ->get();
        return ['areas'=>$areas,
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
   
}

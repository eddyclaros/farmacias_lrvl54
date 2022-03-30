<?php

namespace App\Http\Controllers;

use App\Rrh_Profesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RrhProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesion= Rrh_Profesion::orderby('nombre','asc')->paginate(50);
        //$profesion = Rrh_Profesion::all();
        return [
                'profesion'=>$profesion
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
        $validator=Validator::make($request->all(),['nombre'=>'unique:rrh__profesions']);

        //dd($validator->errors());
        
        if($validator->fails())
        {
            return 'error';
        }
        
        $profesion = new Rrh_Profesion();

        $profesion->nombre=$request->nombre;
        $profesion->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rrh_Profesion  $rrh_Profesion
     * @return \Illuminate\Http\Response
     */
    public function show(Rrh_Profesion $rrh_Profesion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rrh_Profesion  $rrh_Profesion
     * @return \Illuminate\Http\Response
     */
    public function edit(Rrh_Profesion $rrh_Profesion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rrh_Profesion  $rrh_Profesion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rrh_Profesion $rrh_Profesion)
    {
        $profesion = Rrh_Profesion::findOrFail($request->id);

        $profesion->nombre=$request->nombre;
        $profesion->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rrh_Profesion  $rrh_Profesion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rrh_Profesion $rrh_Profesion)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $profesion = Rrh_Profesion::findOrFail($request->id);
        $profesion->activo=0;
        $profesion->save();
    }

    public function activar(Request $request)
    {
        $profesion = Rrh_Profesion::findOrFail($request->id);
        $profesion->activo=1;
        $profesion->save();
    }
}

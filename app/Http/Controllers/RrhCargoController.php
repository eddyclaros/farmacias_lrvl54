<?php

namespace App\Http\Controllers;

use App\Rrh_Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RrhCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargo= Rrh_Cargo::orderby('nivel','asc')
                            ->orderby('nombre','asc')
                            ->paginate(50);
        //$cargo = Rrh_Cargo::all();
        return [
                'cargo'=>$cargo
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
        $validator=Validator::make($request->all(),['nombre'=>'unique:rrh__cargos']);

        //dd($validator->errors());
        
        if($validator->fails())
        {
            return 'error';
        }
        
        $cargo = new Rrh_Cargo();

        $cargo->nombre=$request->nombre;
        $cargo->nivel=$request->nivel;
        $cargo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rrh_Cargo  $rrh_Cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Rrh_Cargo $rrh_Cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rrh_Cargo  $rrh_Cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Rrh_Cargo $rrh_Cargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rrh_Cargo  $rrh_Cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rrh_Cargo $rrh_Cargo)
    {
        $cargo = Rrh_Cargo::findOrFail($request->id);

        $cargo->nombre=$request->nombre;
        $cargo->nivel=$request->nivel;
        $cargo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rrh_Cargo  $rrh_Cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rrh_Cargo $rrh_Cargo)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $cargo = Rrh_Cargo::findOrFail($request->id);
        $cargo->activo=0;
        $cargo->save();
    }

    public function activar(Request $request)
    {
        $cargo = Rrh_Cargo::findOrFail($request->id);
        $cargo->activo=1;
        $cargo->save();
    }
    public function selectCargo(Request $request)
    {
        

    }
}

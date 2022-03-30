<?php

namespace App\Http\Controllers;

use App\Rrh_Formacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RrhFormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formacion= Rrh_Formacion::orderby('nombre','asc')->paginate(50);
        //$formacion = Rrh_Formacion::all();
        return [
                'formacion'=>$formacion
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
        $validator=Validator::make($request->all(),['nombre'=>'unique:rrh__formacions']);

        //dd($validator->errors());
        
        if($validator->fails())
        {
            return 'error';
        }
        
        $formacion = new Rrh_Formacion();

        $formacion->nombre=$request->nombre;
        $formacion->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rrh_Formacion  $rrh_Formacion
     * @return \Illuminate\Http\Response
     */
    public function show(Rrh_Formacion $rrh_Formacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rrh_Formacion  $rrh_Formacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Rrh_Formacion $rrh_Formacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rrh_Formacion  $rrh_Formacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rrh_Formacion $rrh_Formacion)
    {
        $formacion = Rrh_Formacion::findOrFail($request->id);

        $formacion->nombre=$request->nombre;
        $formacion->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rrh_Formacion  $rrh_Formacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rrh_Formacion $rrh_Formacion)
    {
        //
    }
    public function desactivar(Request $request)
    {
        $formacion = Rrh_Formacion::findOrFail($request->id);
        $formacion->activo=0;
        $formacion->save();
    }

    public function activar(Request $request)
    {
        $formacion = Rrh_Formacion::findOrFail($request->id);
        $formacion->activo=1;
        $formacion->save();
    }
}

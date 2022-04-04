<?php

namespace App\Http\Controllers;

use App\Par_Modulo;
use App\Par_VentanaModulo;
use Illuminate\Http\Request;

class ParVentanaModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Par_VentanaModulo  $par_VentanaModulo
     * @return \Illuminate\Http\Response
     */
    public function show(Par_VentanaModulo $par_VentanaModulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Par_VentanaModulo  $par_VentanaModulo
     * @return \Illuminate\Http\Response
     */
    public function edit(Par_VentanaModulo $par_VentanaModulo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Par_VentanaModulo  $par_VentanaModulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Par_VentanaModulo $par_VentanaModulo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Par_VentanaModulo  $par_VentanaModulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Par_VentanaModulo $par_VentanaModulo)
    {
        //
    }
    public function listarPermisos()
    {
        $modulos=Par_Modulo::where('activo',1)->get();
        $ventanas =Par_VentanaModulo::where('activo',1)->get();

        foreach ($modulos as $value) {
            $ventanas =Par_VentanaModulo::where('idmodulo',$value->id)
                                            ->where('activo',1)->get();
            $value->ventana=$ventanas;
        }
        return $modulos;
    }
    public function listarVentanas()
    {
        $ventanas =Par_VentanaModulo::where('activo',1)->get();

        return $ventanas;
    }
}

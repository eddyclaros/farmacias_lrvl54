<?php

namespace App\Http\Controllers;

use App\Alm_Codificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmCodificacionController extends Controller
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
        $codificacion= new Alm_Codificacion();
        $codificacion->idsucursal=$request->idsucursal;
        $codificacion->legraestante=$request->letraestante;
        $codificacion->numposicion=$request->numposicion;
        $codificacion->numaltura=$request->numaltura;
        $codificacion->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alm_Codificacion $alm_Codificacion)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\VentaMaestro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaMaestroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //dd($request);
        $ventamaestro = new VentaMaestro();

        $ventamaestro->num_documento=1;
        $ventamaestro->tipodocumento=1;
        $ventamaestro->idcliente=$request->idcliente;
        $ventamaestro->total=$request->total;
        $ventamaestro->efectivo=$request->efectivo;
        $ventamaestro->cambio=$request->cambio;
        /* $ventamaestro->idusuario=1;
        $ventamaestro->idsucursal=1; */
        $ventamaestro->save();
        $id=$ventamaestro->id;
        
        DB::table('ventas')
            ->where('estado', 0)
            ->update(['estado' => 1,
                        'idventamaestro'=>$id]);
        return 'correcto';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function show(VentaMaestro $ventaMaestro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function edit(VentaMaestro $ventaMaestro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VentaMaestro $ventaMaestro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VentaMaestro  $ventaMaestro
     * @return \Illuminate\Http\Response
     */
    public function destroy(VentaMaestro $ventaMaestro)
    {
        //
    }
    public function registrarVentaMaestro()
    {
        //$venta=Venta::
        DB::table('ventas')
                ->where('estado', 0)
                ->update(['estado' => 1]);
    }
}

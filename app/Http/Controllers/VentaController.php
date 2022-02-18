<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
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
        $venta = new Venta();

        
        $venta->idprestacion=$request->idprestacion;
        $venta->iddescuento=$request->iddescuento;
        $venta->monto_cancelado=$request->monto_cancelado;
        $venta->idventamaestro=1;
        $venta->idusuario=1;
        $venta->idsucursal=1;
        $venta->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
    public function ventasListar()
    {
        $raw=DB::raw('concat(areas.codigo,prestacions.codigo) as cod');
        $raw2=DB::raw('concat(descuentos.nombre," ",monto,IF(siporcentaje=1, "%", "Bs.")) as descuento');
        $ventas=Venta::select($raw,$raw2,
                        'ventas.id as id',
                        'prestacions.nombre as nompres',
                        'prestacions.precio',
                        'descuentos.nombre as nomdesc',
                        'monto_cancelado',
                        'estado')
                        ->join('prestacions','prestacions.id','ventas.idprestacion')
                        ->join('areas','areas.id','prestacions.idarea')
                        ->leftjoin('descuentos','descuentos.id','ventas.iddescuento')
                        ->where('estado',0)
                        ->orderby('ventas.created_at','asc')
                        ->get();

        $raw =DB::raw('sum(monto_cancelado) as total');                       
        $sumatotal=Venta::select($raw)
                            ->where('estado',0)
                            ->get();
        return ['ventas'=>$ventas,
                'sumatotal'=>$sumatotal];
    }
    public function desactivar(Request $request)
    {
        $venta = Venta::findOrFail($request->id);
        $venta->estado=2;
        $venta->save();
    }
    

}

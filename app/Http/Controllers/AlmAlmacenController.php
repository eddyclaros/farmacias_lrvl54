<?php

namespace App\Http\Controllers;

use App\Alm_Almacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmAlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(codestante like '%".$valor."%' or razon_social like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (codestante like '%".$valor."%' or razon_social like '%".$valor."%')" ;
                    }
    
                }
                $estantes= Alm_Almacen::join('adm__sucursals','adm__sucursals.id','alm__codificacions.idsucursal')
                                            ->select('alm__codificacions.id',
                                                    'razon_social',
                                                     'telefonos',
                                                     'idsucursal',
                                                     'letraestante',
                                                     'codestante',
                                                     'numposicion',
                                                     'numaltura',
                                                     'alm__codificacions.activo')
                                            ->orderby('letraestante','asc');
                                            if($request->idsucursal!=0)
                                                $estantes=$estantes->where('idsucursal',$request->idsucursal);
                                            $estantes=$estantes->whereraw($sqls)
                                            ->paginate(40);
            }
        }
        
        else
        {
            $estantes= Alm_Almacen::join('adm__sucursals','adm__sucursals.id','alm__codificacions.idsucursal')
                                        ->select('alm__codificacions.id',
                                                'razon_social',
                                                'telefonos',
                                                'idsucursal',
                                                'letraestante',
                                                'codestante',
                                                'numposicion',
                                                'numaltura',
                                                'alm__codificacions.activo')
                                        ->orderby('letraestante','asc')
                                        ->where('idsucursal',$request->idsucursal)
                                        ->paginate(40);
        }
        $maxletra = Alm_Almacen::select(DB::raw('max(numletra) as maximo'))
                                ->where('idsucursal',$request->idsucursal)
                                ->get();
        
        $sigletra=$maxletra[0]->maximo;
        //dd($sigletra);
        if(is_null($sigletra))
            $sigletra=1;
        else
            $sigletra=$sigletra+1;

        
        $letra=$this->getByPosition($sigletra);
        
        


        return ['pagination'=>[
            'total'         =>    $estantes->total(),
            'current_page'  =>    $estantes->currentPage(),
            'per_page'      =>    $estantes->perPage(),
            'last_page'     =>    $estantes->lastPage(),
            'from'          =>    $estantes->firstItem(),
            'to'            =>    $estantes->lastItem(),

        ] ,
                'estantes'=>$estantes,
                'letra'=>$letra,
                'numletra'=>$sigletra

            ]; */
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
        $almacen= new Alm_Almacen();
        $almacen->idsucursal=$request->idsucursal;
        $almacen->idproducto=$request->idproducto;
        $almacen->idusuario=1;
        $almacen->cantidad=$request->cantidad;
        $almacen->tipo_entrada=$request->tipo_entrada;
        $almacen->lote=$request->lote;
        $almacen->fecha_vencimiento=$request->fecha_vencimiento;
        $almacen->codigo='abc1234';
        $almacen->registro_sanitario=$request->registro_sanitario;
        $almacen->ubicacion_estante=$request->ubicacion_estante;
        $almacen->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alm_Almacen  $alm_Almacen
     * @return \Illuminate\Http\Response
     */
    public function show(Alm_Almacen $alm_Almacen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alm_Almacen  $alm_Almacen
     * @return \Illuminate\Http\Response
     */
    public function edit(Alm_Almacen $alm_Almacen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alm_Almacen  $alm_Almacen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alm_Almacen $alm_Almacen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alm_Almacen  $alm_Almacen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alm_Almacen $alm_Almacen)
    {
        //
    }
}

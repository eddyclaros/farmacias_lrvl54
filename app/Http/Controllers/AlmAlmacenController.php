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
        $buscararray=array();
        $raw=DB::raw('concat(prod__productos.nombre," ",prod__dispensers.nombre," ",prod__productos.cantidad," ",prod__forma_farmaceuticas.nombre) as codprod');
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(prod__productos.codigo like '%".$valor."%' 
                                or prod__productos.nombre like '%".$valor."%' 
                                or prod__dispensers.nombre like '%".$valor."%' 
                                or prod__forma_farmaceuticas.nombre like '%".$valor."%' 
                                or prod__categorias.nombre like '%".$valor."%' 
                                or alm__almacens.codigo like '%".$valor."%' 
                                or alm__almacens.lote like '%".$valor."%' 
                                or alm__almacens.registro_sanitario like '%".$valor."%' )" ;
                    }
                    else
                    {
                        $sqls.=" and (prod__productos.codigo like '%".$valor."%' 
                                or prod__productos.nombre like '%".$valor."%' 
                                or prod__dispensers.nombre like '%".$valor."%' 
                                or prod__forma_farmaceuticas.nombre like '%".$valor."%' 
                                or prod__categorias.nombre like '%".$valor."%' 
                                or alm__almacens.codigo like '%".$valor."%' 
                                or alm__almacens.lote like '%".$valor."%' 
                                or alm__almacens.registro_sanitario like '%".$valor."%' )" ;
                    }
    
                }
                $productos= Alm_Almacen::join('prod__productos','prod__productos.id','alm__almacens.idproducto')
                                        ->join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                        ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                        ->join('prod__categorias','prod__categorias.id','prod__productos.idcategoria')
                                            ->select($raw,
                                                    'alm__almacens.id as id',
                                                    'alm__almacens.cantidad',
                                                    'tipo_entrada',
                                                    'lote',
                                                    'fecha_vencimiento',
                                                    'alm__almacens.codigo',
                                                    'registro_sanitario',
                                                    'ubicacion_estante',
                                                    'alm__almacens.activo')
                                            ->orderby('ubicacion_estante','asc')
                                            ->where('idsucursal',$request->idsucursal)
                                            ->whereraw($sqls)
                                            ->paginate(40);
            }
        }
        
        else
        {
            $productos= Alm_Almacen::join('prod__productos','prod__productos.id','alm__almacens.idproducto')
                                    ->join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                    ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                    ->join('prod__categorias','prod__categorias.id','prod__productos.idcategoria')
                                        ->select($raw,
                                                'alm__almacens.id as id',
                                                'alm__almacens.cantidad',
                                                'tipo_entrada',
                                                'lote',
                                                'fecha_vencimiento',
                                                'alm__almacens.codigo',
                                                'registro_sanitario',
                                                'ubicacion_estante',
                                                'alm__almacens.activo')
                                        ->orderby('ubicacion_estante','asc')
                                        ->where('idsucursal',$request->idsucursal)
                                        ->paginate(40);
        }
        return ['pagination'=>[
            'total'         =>    $productos->total(),
            'current_page'  =>    $productos->currentPage(),
            'per_page'      =>    $productos->perPage(),
            'last_page'     =>    $productos->lastPage(),
            'from'          =>    $productos->firstItem(),
            'to'            =>    $productos->lastItem(),

        ] ,
                'productos'=>$productos,
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
        $almacen= new Alm_Almacen();
        $almacen->idsucursal=$request->idsucursal;
        $almacen->idproducto=$request->idproducto;
        $almacen->idusuario=$request->idusuario;
        $almacen->cantidad=$request->cantidad;
        $almacen->tipo_entrada=$request->tipo_entrada;
        $almacen->lote=$request->lote;
        $almacen->fecha_vencimiento=$request->fecha_vencimiento;
        $almacen->codigo=$request->codigo;
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
    public function desactivar(Request $request)
    {
        $producto = Alm_Almacen::findOrFail($request->id);
        $producto->activo=0;
        $producto->save();
    }

    public function activar(Request $request)
    {
        $producto = Alm_Almacen::findOrFail($request->id);
        $producto->activo=1;
        $producto->save();
    }
}

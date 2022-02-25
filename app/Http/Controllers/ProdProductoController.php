<?php

namespace App\Http\Controllers;

use App\Prod_Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class ProdProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscararray=array();
        if(!empty($request->buscar)){
            $buscararray = explode(" ",$request->buscar);
            //dd($buscararray);
            $valor=sizeof($buscararray);
            if($valor > 0){
                $sqls='';
                foreach($buscararray as $valor){
                    if(empty($sqls)){
                        $sqls="(codigo like '%".$valor."%' or nombre like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (codigo like '%".$valor."%' or nombre like '%".$valor."%')" ;
                    }
    
                }
                $producto= Prod_Producto::orderby('nombre','asc')->whereraw($sqls)->paginate(20);
            }
        }
        
        else
        {
            $producto= Prod_Producto::orderby('nombre','asc')->paginate(20);
        }
        
        //$producto = Prod_Producto::all();
        return ['pagination'=>[
            'total'         =>    $producto->total(),
            'current_page'  =>    $producto->currentPage(),
            'per_page'      =>    $producto->perPage(),
            'last_page'     =>    $producto->lastPage(),
            'from'          =>    $producto->firstItem(),
            'to'            =>    $producto->lastItem(),

        ] ,
                'producto'=>$producto,
                ];
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        //$validator=Validator::make($request->all(),['nombre'=>'unique:prod__productos']);

        //dd($validator->errors());
        /* 
        if($validator->fails())
        {
            return 'error';
        } */

        $maxcorrelativo = Prod_Producto::select(DB::raw('max(correlativo) as maximo'))
                                ->where('idlinea',$request->idlinea)
                                ->get()->toArray();

        //dd($maxcorrelativo);
        $correlativo=$maxcorrelativo[0]['maximo'];
        //dd($correlativo);
        if(is_null($correlativo))
            $correlativo=1;
        else
            $correlativo=$correlativo+1;

        if($correlativo<10)
            $codigo='000'.$correlativo;
        else
            if($correlativo<100)
                $codigo='00'.$correlativo;
            else
                if($correlativo<1000)
                    $codigo='0';
                else
                    $codigo=$correlativo;
        
        $codigo=$request->codigolinea.$codigo;
        $producto = new Prod_Producto();

        
        $producto->idlinea=$request->idlinea;
        $producto->idlinea=$codigo;
        $producto->idlinea=$correlativo;
        $producto->nombre=$request->nombre;
        $producto->idproducto=$request->idproducto;
        $producto->cantidad_producto=$request->cantidad_producto;
        $producto->idformafarm=$request->idformafarm;
        $producto->indicaciones=$request->indicaciones;
        $producto->dosificacion=$request->dosificacion;
        $producto->accion_terapeutica=$request->accion_terapeutica;
        $producto->principio_activo=$request->principio_activo;
        $producto->imagen='imagen';
        $producto->tiempo_pedido=$request->tiempo_pedido;
        $producto->precio_lista=$request->precio_lista;
        $producto->precio_venta=$request->precio_venta;
        $producto->save();
        //return $validador;
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
        $producto = Prod_Producto::findOrFail($request->id);

        $producto->nombre=$request->nombre;
        $producto->save();
    }

    public function desactivar(Request $request)
    {
        $producto = Prod_Producto::findOrFail($request->id);
        $producto->activo=0;
        $producto->save();
    }

    public function activar(Request $request)
    {
        $producto = Prod_Producto::findOrFail($request->id);
        $producto->activo=1;
        $producto->save();
    }
    public function selectProd_Producto()
    {
        $producto=Prod_Producto::select('nombre',
                            'id')
                    ->where('activo',1)
                    ->orderby('nombre','asc')
                    ->get();
        return $producto;
        

    }
   
}

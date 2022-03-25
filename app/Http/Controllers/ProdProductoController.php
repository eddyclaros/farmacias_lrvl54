<?php

namespace App\Http\Controllers;

use App\Prod_Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



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
                        $sqls="(prod__productos.codigo like '%".$valor."%' 
                                or prod__productos.nombre like '%".$valor."%' 
                                or prod__lineas.nombre like '%".$valor."%' 
                                or prod__categorias.nombre like '%".$valor."%' 
                                or prod__dispensers.nombre like '%".$valor."%' 
                                or prod__forma_farmaceuticas.nombre like '%".$valor."%'
                                or prod__lineas.codigo like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (prod__productos.codigo like '%".$valor."%' 
                                    or prod__productos.nombre like '%".$valor."%' 
                                    or prod__lineas.nombre like '%".$valor."%' 
                                    or prod__categorias.nombre like '%".$valor."%' 
                                    or prod__dispensers.nombre like '%".$valor."%' 
                                    or prod__forma_farmaceuticas.nombre like '%".$valor."%'
                                    or prod__lineas.codigo like '%".$valor."%')" ;
                    }
    
                }
                $producto= Prod_Producto::join('prod__lineas','prod__lineas.id','prod__productos.idlinea')
                                            ->join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                            ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                            ->join('prod__categorias','prod__categorias.id','prod__productos.idcategoria')
                                            ->select('prod__lineas.nombre as nombrelinea',
                                                        'prod__dispensers.nombre as nombredispenser',
                                                        'prod__categorias.nombre as nombrecategoria',
                                                        'prod__forma_farmaceuticas.nombre as nombreformafarm',
                                                        'prod__productos.codigo as codproducto',
                                                        'prod__productos.nombre as nombreproducto',
                                                        'prod__productos.id as idproducto',
                                                        'cantidad',
                                                        'indicaciones',
                                                        'dosificacion',
                                                        'accion_terapeutica',
                                                        'principio_activo',
                                                        'imagen',
                                                        'tiempo_pedido',
                                                        'precio_lista',
                                                        'precio_venta',
                                                        'prod__productos.estado',
                                                        'prod__productos.activo',
                                                        'prod__productos.id as id',
                                                        'iddispenser',
                                                        'idformafarm',
                                                        'idlinea',
                                                        'idcategoria',
                                                        'metodoabc'
                                                        )
                                            ->where('prod__productos.estado',1)
                                            ->orderby('prod__productos.nombre','asc')->whereraw($sqls)->paginate(30);
            }
        }
        
        else
        {
            $producto= Prod_Producto::join('prod__lineas','prod__lineas.id','prod__productos.idlinea')
                                        ->join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                        ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                        ->join('prod__categorias','prod__categorias.id','prod__productos.idcategoria')
                                        ->select('prod__lineas.nombre as nombrelinea',
                                                    'prod__dispensers.nombre as nombredispenser',
                                                    'prod__forma_farmaceuticas.nombre as nombreformafarm',
                                                    'prod__categorias.nombre as nombrecategoria',
                                                    'prod__productos.codigo as codproducto',
                                                    'prod__productos.nombre as nombreproducto',
                                                    'prod__productos.id as idproducto',
                                                    'cantidad',
                                                    'indicaciones',
                                                    'dosificacion',
                                                    'accion_terapeutica',
                                                    'principio_activo',
                                                    'imagen',
                                                    'tiempo_pedido',
                                                    'precio_lista',
                                                    'precio_venta',
                                                    'prod__productos.estado',
                                                    'prod__productos.activo',
                                                    'prod__productos.id as id',
                                                    'iddispenser',
                                                    'idformafarm',
                                                    'idlinea',
                                                    'idcategoria',
                                                    'metodoabc')
                                        ->where('prod__productos.estado',1)
                                        ->orderby('prod__productos.nombre','asc')
                                        ->paginate(30);
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

        $var = Str::random(32);
        $var.='.jpg'; 
        $value = substr($request->imagen, strpos($request->imagen, ',') + 1); 
        $value = base64_decode($value); 
        Storage::put('app/public/producto/'.$var, $value);
 

        $producto = new Prod_Producto();

        
        $producto->idlinea=$request->idlinea;
        $producto->codigo=$request->cod.$codigo;
        $producto->correlativo=$correlativo;
        $producto->nombre=$request->nombre;
        $producto->iddispenser=$request->iddispenser;
        $producto->cantidad=$request->cantidad;
        $producto->idformafarm=$request->idformafarm;
        $producto->indicaciones=$request->indicaciones;
        $producto->dosificacion=$request->dosificacion;
        $producto->accion_terapeutica=$request->accion_terapeutica;
        $producto->principio_activo=$request->principio_activo;
        $producto->imagen=$var;
        $producto->tiempo_pedido=$request->tiempo_pedido;
        $producto->precio_lista=$request->precio_lista;
        $producto->precio_venta=$request->precio_venta;
        $producto->idcategoria=$request->idcategoria;
        $producto->metodoabc=$request->metodoabc;
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

        $producto->idlinea=$request->idlinea;
        $producto->nombre=$request->nombre;
        $producto->iddispenser=$request->iddispenser;
        $producto->cantidad=$request->cantidad;
        $producto->idformafarm=$request->idformafarm;
        $producto->indicaciones=$request->indicaciones;
        $producto->dosificacion=$request->dosificacion;
        $producto->accion_terapeutica=$request->accion_terapeutica;
        $producto->principio_activo=$request->principio_activo;
        $producto->imagen=$request->imagen;
        $producto->tiempo_pedido=$request->tiempo_pedido;
        $producto->precio_lista=$request->precio_lista;
        $producto->precio_venta=$request->precio_venta;
        $producto->metodoabc=$request->metodoabc;
        $producto->idcategoria=$request->idcategoria;
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
    /* public function selectProd_Producto()
    {
        $producto=Prod_Producto::select('nombre',
                            'id')
                    ->where('activo',1)
                    ->orderby('nombre','asc')
                    ->get();
        return $producto;
        

    } */
    public function selectProducto(Request $request)
    {
        $buscararray = array(); 
        if(!empty($request->buscar)) $buscararray = explode(" ",$request->buscar); 
        $raw=DB::raw(DB::raw('concat(prod__productos.codigo," ",prod__productos.nombre," ",prod__dispensers.nombre," ",prod__productos.cantidad," ",prod__forma_farmaceuticas.nombre) as cod'));
        if (sizeof($buscararray)>0) { 
            $sqls=''; 
            foreach($buscararray as $valor){
                if(empty($sqls))
                    $sqls="(prod__productos.codigo like '%".$valor."%' or prod__productos.nombre like '%".$valor."%' or prod__dispensers.nombre like '%".$valor."%' or prod__forma_farmaceuticas.nombre like '%".$valor."%' )";
                else
                    $sqls.=" and (prod__productos.codigo like '%".$valor."%' or prod__productos.nombre like '%".$valor."%' or prod__dispensers.nombre like '%".$valor."%' or prod__forma_farmaceuticas.nombre like '%".$valor."%')";
            }   
            $productos = Prod_Producto::join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                        ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                        ->select('prod__productos.id as id' ,
                                                    $raw,
                                                    'prod__productos.nombre as nombre',
                                                    'prod__productos.codigo')
                                        ->where('prod__productos.activo',1)
                                        ->whereraw($sqls)
                                        ->orderby('prod__productos.nombre','asc')
                                        ->get();
        }
        else {
            if ($request->id){
                    $productos = Prod_Producto::join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                                ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                                ->select('prod__productos.id as id' ,
                                                            $raw,
                                                            'prod__productos.nombre as nombre',
                                                            'prod__productos.codigo')
                                                ->where('prod__productos.activo',1)
                                                ->where('id',$request->id)
                                                ->orderby('prod__productos.nombre','asc')
                                                ->get();
                    
            }

            else
            {
                $productos = Prod_Producto::join('prod__dispensers','prod__dispensers.id','prod__productos.iddispenser')
                                            ->join('prod__forma_farmaceuticas','prod__forma_farmaceuticas.id','prod__productos.idformafarm')
                                            ->select('prod__productos.id as id' ,
                                                        $raw,
                                                        'prod__productos.nombre as nombre',
                                                        'prod__productos.codigo')
                                            ->where('prod__productos.activo',1)
                                            ->orderby('prod__productos.nombre','asc')
                                            ->get();
            }
              
        }
        return ['productos' => $productos];
        

    }
   
}

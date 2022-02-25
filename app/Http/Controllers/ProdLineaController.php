<?php

namespace App\Http\Controllers;

use App\Prod_Linea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdLineaController extends Controller
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
                        $sqls="(codigo like '%".$valor."%' or nombre like '%".$valor."%' or descripcion like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (codigo like '%".$valor."%' or nombre like '%".$valor."%' or descripcion like '%".$valor."%')" ;
                    }
    
                }
                $lineas= Prod_Linea::orderby('codigo','asc')->whereraw($sqls)->paginate(20);
            }
        }
        
        else
        {
            $lineas= Prod_Linea::orderby('codigo','asc')->paginate(20);
        }
        
        //$lineas = Prod_Linea::all();
        
        $maxcorrelativo = Prod_Linea::select(DB::raw('max(correlativo) as maximo'))
                                ->get();
        return ['pagination'=>[
            'total'         =>    $lineas->total(),
            'current_page'  =>    $lineas->currentPage(),
            'per_page'      =>    $lineas->perPage(),
            'last_page'     =>    $lineas->lastPage(),
            'from'          =>    $lineas->firstItem(),
            'to'            =>    $lineas->lastItem(),

        ] ,
                'lineas'=>$lineas,
                'maxcorrelativo'=>$maxcorrelativo];
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $letracodigo='P';
        $maxcorrelativo = Prod_Linea::select(DB::raw('max(correlativo) as maximo'))
                                ->get()->toArray();
        //dd($maxcorrelativo);
        $correlativo=$maxcorrelativo[0]['maximo'];
        //dd($correlativo);
        if(is_null($correlativo))
            $correlativo=1;
        else
            $correlativo=$correlativo+1;

        if($correlativo<10)
            $codigo='1000'.$correlativo;
        else
            if($correlativo<100)
                $codigo='100'.$correlativo;
            else
                if($correlativo<1000)
                    $codigo='10';
                else
                    $codigo='1'.$correlativo;
        
        $codigo=$letracodigo.$codigo;
        
        $linea = new Prod_Linea();
        $linea->codigo=$codigo;
        $linea->correlativo=$correlativo;
        $linea->nombre=$request->nombre;
        $linea->descripcion=$request->descripcion;
        $linea->tiempo_demora=$request->tiempo_demora;
        $linea->usuario_registro=1;
        $linea->usuario_modifica=1;
        
        $linea->save();
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
        $linea = Prod_Linea::findOrFail($request->id);

        $linea->nombre=$request->nombre;
        $linea->descripcion=$request->descripcion;
        $linea->tiempo_demora=$request->tiempo_demora;
        $linea->usuario_modifica=1;
        $linea->save();
    }

    public function desactivar(Request $request)
    {
        $linea = Prod_Linea::findOrFail($request->id);
        $linea->activo=0;
        $linea->save();
    }

    public function activar(Request $request)
    {
        $linea = Prod_Linea::findOrFail($request->id);
        $linea->activo=1;
        $linea->save();
    }
    public function selectLinea(Request $request)
    {
        $buscararray = array(); 
        if(!empty($request->buscar)) $buscararray = explode(" ",$request->buscar); 
        $raw=DB::raw(DB::raw('concat(codigo," ",nombre) as cod'));
        if (sizeof($buscararray)>0) { 
            $sqls=''; 
            foreach($buscararray as $valor){
                if(empty($sqls))
                    $sqls="(codigo like '%".$valor."%' or nombre like '%".$valor."%' )";
                else
                    $sqls.=" and (codigo like '%".$valor."%' or nombre like '%".$valor."%' )";
            }   
            $lineas = Prod_Linea::select($raw,'id','nombre')
                                ->where('activo',1)
                                ->whereraw($sqls)
                                ->orderby('codigo','asc')
                                ->get();
        }
        else {
            if ($request->id){
                    $lineas = Prod_Linea::select($raw,'id','nombre')
                                                 ->where('activo',1)
                                                ->where('id',$request->id)
                                                ->orderby('codigo','asc')
                                                ->get();
            }

            else
            {
                $lineas = Prod_Linea::select($raw,'id','nombre')
                                    ->where('activo',1)
                                    ->orderby('codigo','asc')
                                    ->get();
            }
              
        }
        return ['lineas' => $lineas];
        

    }
   
}
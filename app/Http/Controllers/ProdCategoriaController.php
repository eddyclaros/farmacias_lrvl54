<?php

namespace App\Http\Controllers;

use App\Prod_Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdCategoriaController extends Controller
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
                        $sqls="(nombre like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (nombre like '%".$valor."%')" ;
                    }
    
                }
                $categoria= Prod_Categoria::orderby('nombre','asc')->whereraw($sqls)->paginate(20);
            }
        }
        
        else
        {
            $categoria= Prod_Categoria::orderby('nombre','asc')->paginate(20);
        }
        
        //$categoria = Prod_Categoria::all();
        return ['pagination'=>[
            'total'         =>    $categoria->total(),
            'current_page'  =>    $categoria->currentPage(),
            'per_page'      =>    $categoria->perPage(),
            'last_page'     =>    $categoria->lastPage(),
            'from'          =>    $categoria->firstItem(),
            'to'            =>    $categoria->lastItem(),

        ] ,
                'categoria'=>$categoria,
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
        $validator=Validator::make($request->all(),['nombre'=>'unique:prod__categorias']);

        //dd($validator->errors());
        
        if($validator->fails())
        {
            return 'error';
        }
        
        $categoria = new Prod_Categoria();

        $categoria->nombre=$request->nombre;
        $categoria->save();
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
        $categoria = Prod_Categoria::findOrFail($request->id);

        $categoria->nombre=$request->nombre;
        $categoria->save();
    }

    public function desactivar(Request $request)
    {
        $categoria = Prod_Categoria::findOrFail($request->id);
        $categoria->activo=0;
        $categoria->save();
    }

    public function activar(Request $request)
    {
        $categoria = Prod_Categoria::findOrFail($request->id);
        $categoria->activo=1;
        $categoria->save();
    }
    public function selectFormaFarm(Request $request)
    {
        $buscararray = array(); 
        if(!empty($request->buscar)) $buscararray = explode(" ",$request->buscar); 
        if (sizeof($buscararray)>0) { 
            $sqls=''; 
            foreach($buscararray as $valor){
                if(empty($sqls))
                    $sqls="(nombre like '%".$valor."%' )";
                else
                    $sqls.=" and (nombre like '%".$valor."%' )";
            }   
            $categoria = Prod_Categoria::select('id','nombre')
                                ->where('activo',1)
                                ->whereraw($sqls)
                                ->orderby('nombre','asc')
                                ->get();
        }
        else {
            if ($request->id){
                    $categoria = Prod_Categoria::select('id','nombre')
                                                 ->where('activo',1)
                                                ->where('id',$request->id)
                                                ->orderby('nombre','asc')
                                                ->get();
            }

            else
            {
                $categoria = Prod_Categoria::select('id','nombre')
                                    ->where('activo',1)
                                    ->orderby('nombre','asc')
                                    ->get();
            }
              
        }
        return ['categoria' => $categoria];

    }
   
}

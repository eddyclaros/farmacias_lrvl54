<?php

namespace App\Http\Controllers;

use App\Prod_Dispenser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdDispenserController extends Controller
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
                $dispenser= Prod_Dispenser::orderby('nombre','asc')->whereraw($sqls)->paginate(20);
            }
        }
        
        else
        {
            $dispenser= Prod_Dispenser::orderby('nombre','asc')->paginate(20);
        }
        
        //$dispenser = Prod_Dispenser::all();
        return ['pagination'=>[
            'total'         =>    $dispenser->total(),
            'current_page'  =>    $dispenser->currentPage(),
            'per_page'      =>    $dispenser->perPage(),
            'last_page'     =>    $dispenser->lastPage(),
            'from'          =>    $dispenser->firstItem(),
            'to'            =>    $dispenser->lastItem(),

        ] ,
                'dispenser'=>$dispenser,
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
       
        $validator=Validator::make($request->all(),['nombre'=>'unique:prod__dispensers']);

        //dd($validator->errors());
        
        if($validator->fails())
        {
            return 'error';
        }

        $dispenser = new Prod_Dispenser();

        $dispenser->nombre=$request->nombre;
        $dispenser->save();
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
        $dispenser = Prod_Dispenser::findOrFail($request->id);

        $dispenser->nombre=$request->nombre;
        $dispenser->save();
    }

    public function desactivar(Request $request)
    {
        $dispenser = Prod_Dispenser::findOrFail($request->id);
        $dispenser->activo=0;
        $dispenser->save();
    }

    public function activar(Request $request)
    {
        $dispenser = Prod_Dispenser::findOrFail($request->id);
        $dispenser->activo=1;
        $dispenser->save();
    }
    public function selectProd_Dispenser()
    {
        $dispenser=Prod_Dispenser::select('nombre',
                            'id')
                    ->where('activo',1)
                    ->orderby('nombre','asc')
                    ->get();
        return $dispenser;
        

    }
   
}

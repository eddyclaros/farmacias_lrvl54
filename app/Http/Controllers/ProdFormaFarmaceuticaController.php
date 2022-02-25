<?php

namespace App\Http\Controllers;

use App\Prod_FormaFarmaceutica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdFormaFarmaceuticaController extends Controller
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
                $formafarm= Prod_FormaFarmaceutica::orderby('nombre','asc')->whereraw($sqls)->paginate(20);
            }
        }
        
        else
        {
            $formafarm= Prod_FormaFarmaceutica::orderby('nombre','asc')->paginate(20);
        }
        
        //$formafarm = Prod_FormaFarmaceutica::all();
        return ['pagination'=>[
            'total'         =>    $formafarm->total(),
            'current_page'  =>    $formafarm->currentPage(),
            'per_page'      =>    $formafarm->perPage(),
            'last_page'     =>    $formafarm->lastPage(),
            'from'          =>    $formafarm->firstItem(),
            'to'            =>    $formafarm->lastItem(),

        ] ,
                'formafarm'=>$formafarm,
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
        $validator=Validator::make($request->all(),['nombre'=>'unique:prod__forma_farmaceuticas']);

        //dd($validator->errors());
        
        if($validator->fails())
        {
            return 'error';
        }
        
        $formafarm = new Prod_FormaFarmaceutica();

        $formafarm->nombre=$request->nombre;
        $formafarm->save();
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
        $formafarm = Prod_FormaFarmaceutica::findOrFail($request->id);

        $formafarm->nombre=$request->nombre;
        $formafarm->save();
    }

    public function desactivar(Request $request)
    {
        $formafarm = Prod_FormaFarmaceutica::findOrFail($request->id);
        $formafarm->activo=0;
        $formafarm->save();
    }

    public function activar(Request $request)
    {
        $formafarm = Prod_FormaFarmaceutica::findOrFail($request->id);
        $formafarm->activo=1;
        $formafarm->save();
    }
    public function selectProd_FormaFarmaceutica()
    {
        $formafarm=Prod_FormaFarmaceutica::select('nombre',
                            'id')
                    ->where('activo',1)
                    ->orderby('nombre','asc')
                    ->get();
        return $formafarm;
        

    }
   
}

<?php

namespace App\Http\Controllers;

use App\Alm_Codificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class AlmCodificacionController extends Controller
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
                        $sqls="(codestante like '%".$valor."%' or razon_social like '%".$valor."%')" ;
                    }
                    else
                    {
                        $sqls.=" and (codestante like '%".$valor."%' or razon_social like '%".$valor."%')" ;
                    }
    
                }
                $estantes= Alm_Codificacion::join('adm__sucursals','adm__sucursals.id','alm__codificacions.idsucursal')
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
                                            ->whereraw($sqls)
                                            ->paginate(40);
            }
        }
        
        else
        {
            $estantes= Alm_Codificacion::join('adm__sucursals','adm__sucursals.id','alm__codificacions.idsucursal')
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
        $maxletra = Alm_Codificacion::select(DB::raw('max(numletra) as maximo'))
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
        
        $codificacion= new Alm_Codificacion();
        $codificacion->idsucursal=$request->idsucursal;
        $codificacion->codestante=$request->codestante;
        $codificacion->letraestante=$request->letraestante;
        $codificacion->numletra=$request->numletra;
        $codificacion->numposicion=$request->numposicion;
        $codificacion->numaltura=$request->numaltura;
        $codificacion->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function show(Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alm_Codificacion  $alm_Codificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alm_Codificacion $alm_Codificacion)
    {
        //
    }

    function getByPosition($index){
        #Crea un array con las letras de la A a la Z
        $alphabet = range('A', 'Z');
        #Seteamos la posición restando 1 porque los índices comienzan en 0
        $pos=$index-1;
        #Retornamos la letra, o NULL, si $index desborda el array
        #Para evitar que true sea tratado como índice 1, controlamos con is_bool también
        return ( !empty($alphabet[$pos]) && !is_bool($index) ) ? $alphabet[$pos] : NULL ;
    }
    function imprimirCodigos(Request $request){

        $estante = Alm_Codificacion::where('id',$request->idestante)
                                    ->get();

        $posicion=$estante[0]->numposicion;
        $altura=$estante[0]->numaltura;
        $codigo=$estante[0]->codestante;

        return view('reporte_estante')->with(['posicion'=>$posicion,
                                            'altura'=>$altura,
                                            'codestante'=>$codigo
                                        ]);
    }
}

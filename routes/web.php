<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DescuentoController;
use App\Http\Controllers\PrestacionController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\VentaMaestroController;
use App\Http\Controllers\ProdLineaController;
use App\Http\Controllers\ProdDispenserController;
use App\Http\Controllers\ProdFormaFarmaceuticaController;
use App\Http\Controllers\ProdProductoController;
use App\Http\Controllers\AdmSucursalController;
use App\Http\Controllers\ProdCategoriaController;
use App\Http\Controllers\AlmCodificacionController;
use App\Http\Controllers\AlmAlmacenController;
use App\Http\Controllers\ProdTipoDescuentoController;
use App\Http\Controllers\ProdDescuentoController;
use App\Http\Controllers\RrhCargoController;
use App\Http\Controllers\RrhEmpleadoController;
use App\Http\Controllers\RrhFormacionController;
use App\Http\Controllers\RrhProfesionController;


Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('pdf',[AlmCodificacionController::class,'pdf']);
Route::get('/area',[AreaController::class,'index']);
Route::post('/area/registrar', [AreaController::class,'store']);
Route::put('/area/actualizar', [AreaController::class,'update']);
Route::put('/area/desactivar', [AreaController::class,'desactivar']);
Route::put('/area/activar', [AreaController::class,'activar']);
Route::get('/area/selectarea',[AreaController::class,'selectArea']);


Route::get('/prestacion',[PrestacionController::class,'index']);
Route::post('/prestacion/registrar', [PrestacionController::class,'store']);
Route::put('/prestacion/actualizar', [PrestacionController::class,'update']);
Route::put('/prestacion/desactivar', [PrestacionController::class,'desactivar']);
Route::put('/prestacion/activar', [PrestacionController::class,'activar']);
Route::get('/prestacion/selectprest',[PrestacionController::class,'selectPrestacion']);
Route::get('/prestacion/selectprestaciones',[PrestacionController::class,'selectPrestaciones']);



Route::get('/descuento',[DescuentoController::class,'index']);
Route::post('/descuento/registrar', [DescuentoController::class,'store']);
Route::put('/descuento/actualizar', [DescuentoController::class,'update']);
Route::put('/descuento/desactivar', [DescuentoController::class,'desactivar']);
Route::put('/descuento/activar', [DescuentoController::class,'activar']);
Route::get('/descuento/selectdescuento',[DescuentoController::class,'selectDescuento']);
Route::get('/obtenerfecha', [DescuentoController::class,'obtenerFecha']);

Route::get('/ventas/listar',[VentaController::class,'ventasListar']);
Route::post('/ventas/registrar', [VentaController::class,'store']);
Route::put('/ventas/desactivar', [VentaController::class,'desactivar']);
Route::put('/ventas/registrarventa', [VentaController::class,'registrarVenta']);
Route::get('/ventas/detalle',[VentaController::class,'ventasDetalle']);

Route::post('/ventamaestro/registrarventamaestro', [VentaMaestroController::class,'store']);
Route::get('/ventasmaestro',[VentaMaestroController::class,'index']);
Route::put('/ventasmaestro/desactivar', [VentaMaestroController::class,'desactivar']);
Route::put('/ventasmaestro/registrarventa', [VentaMaestroController::class,'activar']);






//////////////////*****Conexion con base de datos db_farma******///////////////////// */
Route::get('/clientes',[ClientesController::class,'index']);
Route::get('/clientes/selectclientes',[ClientesController::class,'selectClientes']);
Route::post('/clientes/registrar', [ClientesController::class,'store']);


////////////////////////productos//////////////////////////////
Route::get('/linea',[ProdLineaController::class,'index']);
Route::post('/linea/registrar', [ProdLineaController::class,'store']);
Route::put('/linea/actualizar', [ProdLineaController::class,'update']);
Route::put('/linea/desactivar', [ProdLineaController::class,'desactivar']);
Route::put('/linea/activar', [ProdLineaController::class,'activar']);
Route::get('/linea/selectlinea',[ProdLineaController::class,'selectLinea']);

Route::get('/producto',[ProdProductoController::class,'index']);
Route::post('/producto/registrar', [ProdProductoController::class,'store']);
Route::put('/producto/actualizar', [ProdProductoController::class,'update']);
Route::put('/producto/desactivar', [ProdProductoController::class,'desactivar']);
Route::put('/producto/activar', [ProdProductoController::class,'activar']);
Route::get('/producto/selectproducto',[ProdProductoController::class,'selectProducto']);

Route::get('/dispenser',[ProdDispenserController::class,'index']);
Route::post('/dispenser/registrar', [ProdDispenserController::class,'store']);
Route::put('/dispenser/actualizar', [ProdDispenserController::class,'update']);
Route::put('/dispenser/desactivar', [ProdDispenserController::class,'desactivar']);
Route::put('/dispenser/activar', [ProdDispenserController::class,'activar']);
Route::get('/dispenser/selectdispenser',[ProdDispenserController::class,'selectDispenser']);

Route::get('/formafarm',[ProdFormaFarmaceuticaController::class,'index']);
Route::post('/formafarm/registrar', [ProdFormaFarmaceuticaController::class,'store']);
Route::put('/formafarm/actualizar', [ProdFormaFarmaceuticaController::class,'update']);
Route::put('/formafarm/desactivar', [ProdFormaFarmaceuticaController::class,'desactivar']);
Route::put('/formafarm/activar', [ProdFormaFarmaceuticaController::class,'activar']);
Route::get('/formafarm/selectformafarm',[ProdFormaFarmaceuticaController::class,'selectFormaFarm']);


Route::get('/sucursal',[AdmSucursalController::class,'index']);
Route::post('/sucursal/registrar', [AdmSucursalController::class,'store']);
Route::put('/sucursal/actualizar', [AdmSucursalController::class,'update']);
Route::put('/sucursal/desactivar', [AdmSucursalController::class,'desactivar']);
Route::put('/sucursal/activar', [AdmSucursalController::class,'activar']);
Route::get('/sucursal/selectsucursal',[AdmSucursalController::class,'selectSucursal']);

Route::get('/categoria',[ProdCategoriaController::class,'index']);
Route::post('/categoria/registrar', [ProdCategoriaController::class,'store']);
Route::put('/categoria/actualizar', [ProdCategoriaController::class,'update']);
Route::put('/categoria/desactivar', [ProdCategoriaController::class,'desactivar']);
Route::put('/categoria/activar', [ProdCategoriaController::class,'activar']);
Route::get('/categoria/selectcategoria',[ProdCategoriaController::class,'selectCategoria']);

Route::get('/estante',[AlmCodificacionController::class,'index']);
Route::post('/estante/registrar', [AlmCodificacionController::class,'store']);
Route::put('/estante/actualizar', [AlmCodificacionController::class,'update']);
Route::put('/estante/desactivar', [AlmCodificacionController::class,'desactivar']);
Route::put('/estante/activar', [AlmCodificacionController::class,'activar']);
Route::get('/estante/selectestante',[AlmCodificacionController::class,'selectEstante']);


Route::get ('/imprimir_codigos', [AlmCodificacionController::class,'imprimirCodigos']);

Route::get('/almacen',[AlmAlmacenController::class,'index']);
Route::post('/almacen/registrar', [AlmAlmacenController::class,'store']);
Route::put('/almacen/actualizar', [AlmAlmacenController::class,'update']);
Route::put('/almacen/desactivar', [AlmAlmacenController::class,'desactivar']);
Route::put('/almacen/activar', [AlmAlmacenController::class,'activar']);
Route::get('/almacen/selectalmacen',[AlmAlmacenController::class,'selectAlmacen']);

Route::get('/tipodescuento/selecttipodescuento',[ProdTipoDescuentoController::class,'selectTipoDescuento']);

Route::get('/proddescuento',[ProdDescuentoController::class,'index']);
Route::post('/proddescuento/registrar', [ProdDescuentoController::class,'store']);
Route::put('/proddescuento/actualizar', [ProdDescuentoController::class,'update']);
Route::put('/proddescuento/desactivar', [ProdDescuentoController::class,'desactivar']);
Route::put('/proddescuento/activar', [ProdDescuentoController::class,'activar']);
Route::get('/proddescuento/selectdescuento',[ProdDescuentoController::class,'selectDescuento']);


//rrhh
Route::get('/cargo',[RrhCargoController::class,'index']);
Route::post('/cargo/registrar', [RrhCargoController::class,'store']);
Route::put('/cargo/actualizar', [RrhCargoController::class,'update']);
Route::put('/cargo/desactivar', [RrhCargoController::class,'desactivar']);
Route::put('/cargo/activar', [RrhCargoController::class,'activar']);
Route::get('/cargo/selectcargo',[RrhCargoController::class,'selectCargo']);

Route::get('/profesion',[RrhProfesionController::class,'index']);
Route::post('/profesion/registrar', [RrhProfesionController::class,'store']);
Route::put('/profesion/actualizar', [RrhProfesionController::class,'update']);
Route::put('/profesion/desactivar', [RrhProfesionController::class,'desactivar']);
Route::put('/profesion/activar', [RrhProfesionController::class,'activar']);
Route::get('/profesion/selectcargo',[RrhProfesionController::class,'selectCargo']);

Route::get('/formacion',[RrhFormacionController::class,'index']);
Route::post('/formacion/registrar', [RrhFormacionController::class,'store']);
Route::put('/formacion/actualizar', [RrhFormacionController::class,'update']);
Route::put('/formacion/desactivar', [RrhFormacionController::class,'desactivar']);
Route::put('/formacion/activar', [RrhFormacionController::class,'activar']);
Route::get('/formacion/selectcargo',[RrhFormacionController::class,'selectCargo']);
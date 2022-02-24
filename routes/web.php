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

Route::get('/', function () {
    return view('contenido/contenido');
});


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

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

Route::get('/', function () {
    return view('contenido/contenido');
});

Route::get('/area','AreaController@index');
Route::post('/area/registrar', 'AreaController@store');
Route::put('/area/actualizar', 'AreaController@update');
Route::put('/area/desactivar', 'AreaController@desactivar');
Route::put('/area/activar', 'AreaController@activar');
Route::get('/area/selectarea','AreaController@selectArea');


Route::get('/prestacion','PrestacionController@index');
Route::post('/prestacion/registrar', 'PrestacionController@store');
Route::put('/prestacion/actualizar', 'PrestacionController@update');
Route::put('/prestacion/desactivar', 'PrestacionController@desactivar');
Route::put('/prestacion/activar', 'PrestacionController@activar');
Route::get('/prestacion/selectprest','PrestacionController@selectPrestacion');
Route::get('/prestacion/selectprestaciones','PrestacionController@selectPrestaciones');



Route::get('/descuento','DescuentoController@index');
Route::post('/descuento/registrar', 'DescuentoController@store');
Route::put('/descuento/actualizar', 'DescuentoController@update');
Route::put('/descuento/desactivar', 'DescuentoController@desactivar');
Route::put('/descuento/activar', 'DescuentoController@activar');
Route::get('/descuento/selectdescuento','DescuentoController@selectDescuento');

Route::get('/ventas/listar','VentaController@ventasListar');
Route::post('/ventas/registrar', 'VentaController@store');
Route::put('/ventas/desactivar', 'VentaController@desactivar');
Route::put('/ventas/registrarventa', 'VentaController@registrarVenta');
Route::get('/ventas/detalle','VentaController@ventasDetalle');

Route::post('/ventamaestro/registrarventamaestro', 'VentaMaestroController@store');
Route::get('/ventasmaestro','VentaMaestroController@index');
Route::put('/ventasmaestro/desactivar', 'VentaMaestroController@desactivar');
Route::put('/ventasmaestro/registrarventa', 'VentaMaestroController@activar');


Route::get('/obtenerfecha', 'DescuentoController@obtenerFecha');



//////////////////*****Conexion con base de datos db_farma******///////////////////// */
Route::get('/clientes','ClientesController@index');
Route::get('/clientes/selectclientes','ClientesController@selectClientes');





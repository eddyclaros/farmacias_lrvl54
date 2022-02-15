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
//Route::get('/prestacion/selectarea','PrestacionController@selectArea');

Route::get('/clientes','ClientesController@ingex');

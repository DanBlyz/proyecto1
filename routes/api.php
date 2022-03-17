<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
// contrtoladores para la api 

Route::get('Publicaciones/listado', 'api\PublicacionesController@listado');
Route::post('Dispositivos/registra', 'api\DispositivosController@registra');

// USUARIOS
Route::post('User/registra', 'api\UserController@registra');
Route::get('User/inicio', 'api\UserController@inicio');
Route::post('User/login', 'api\UserController@login');
Route::post('User/familiares', 'api\UserController@familiares');

// LOCALIZACION
Route::post('User/localizacion', 'api\UserController@localizacion');
<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('home', 'SocialController@inicio')->name('home');


/*Route::get('/home', function () {
    return view('home');
});*/

Route::get('/', 'RestaurantController@listadoC');
// Route::get('/', 'home');

Auth::routes();

//USUARIOS
// Route::post('login', 'UserController@login');
Route::post('User/verificaUser','UserController@verificaUser');
Route::post('User/addUser','UserController@addUser');
Route::get('User/logout','UserController@logout');
Route::get('User/registro','UserController@registro');
Route::post('User/validaEmail', 'UserController@validaEmail');

// PANEL DE CONTROL
Route::get('/home', 'PanelController@inicio');
Route::get('Panel/inicio', 'PanelController@inicio');

//RED SOCIAL
// Route::get('Social/inicio', 'SocialController@inicio');
// Route::post('Social/guarda', 'SocialController@guarda');
// Route::get('Social/ajaxPublicaciones', 'SocialController@ajaxPublicaciones');

// RED SOCIAL
Route::get('Social/muromobil', 'SocialController@muromobil');
Route::post('Social/guarda', 'SocialController@guarda');
Route::get('Social/addComent', 'SocialController@addComent');
Route::get('Social/editComent', 'SocialController@editComent');
Route::get('Social/deleteComent', 'SocialController@deleteComent');
Route::get('Social/muestraCategoria', 'SocialController@muestraCategoria');

// USUARIOS
Route::get('User/listado', 'UserController@listado');


// CATEGORIAS TIPOS 
Route::get('Categoria/listado', 'CategoriaController@listado');
Route::post('Categoria/guarda', 'CategoriaController@guarda');
Route::get('Categoria/elimina/{categoria_id}', 'CategoriaController@elimina');
//CATEGORIA GERENTES
Route::get('Categoria/gerente', 'UserController@listadogerente');
Route::post('Categoria/guardagerente', 'UserController@guardagerente');
Route::get('Categoria/eliminaG/{gerente_id}', 'UserController@eliminaG');
//CATEGORIA CLIENTES
Route::get('Categoria/cliente', 'UserController@listadocliente');
Route::post('Categoria/guardacliente', 'UserController@guardacliente');
Route::get('Categoria/eliminaC/{cliente_id}', 'UserController@eliminaC');

//REGISTROS DEL GERENTE
Route::get('Categoria/formG', 'CategoriaController@formG');
Route::post('Categoria/guardaG', 'UserController@guardaG');
//GERENTE CON RESTAURANTES
Route::get('Categoria/restaurantesG', 'RestaurantController@listadoG');
Route::post('Categoria/guardaRes', 'RestaurantController@guardaRes');
Route::get('Categoria/eliminaRes/{res_id}', 'RestaurantController@eliminaRes');
//ADMIN CON RESTAURANT
Route::get('Categoria/restaurantesA', 'RestaurantController@listadoA');
Route::post('Categoria/guardaResA', 'RestaurantController@guardaResA');
//GERENTES CON RESTAURNT Y MENU
Route::get('Categoria/menuP/{res_id}', 'MenuController@listadoM');
Route::post('Categoria/guardaMenu', 'MenuController@guardaMenu');
Route::get('Categoria/eliminaMenu/{menu_id}', 'MenuController@eliminaMenu');

Route::get('Categoria/platillo/{menu_id}', 'PlatilloController@listadoP');
Route::post('Categoria/guardaP', 'PlatilloController@guardaP');
Route::get('Categoria/eliminaP/{platillo_id}', 'PlatilloController@eliminaP');

//REGISTROS DEL CLIENTE
Route::get('Categoria/formC', 'CategoriaController@formC');
Route::post('Categoria/guardaC', 'UserController@guardaC');

//CLIENTE CON RESTAURANTES
Route::get('Social/inicio', 'RestaurantController@listadoC');
Route::get('Categoria/menuC/{res_id}', 'MenuController@listadoC');
Route::get('Categoria/platilloC/{menu_id}', 'PlatilloController@listadoC');

// Route::post('User/ajaxListado', 'UserController@ajaxlistado');
// Route::get('User/nuevo', 'UserController@nuevo');
// Route::post('User/ajaxDistrito', 'UserController@ajaxDistrito');
// Route::post('User/ajaxOtb', 'UserController@ajaxOtb');
// Route::post('User/guarda', 'UserController@guarda');
// Route::get('User/ajax_listado', 'UserController@ajax_listado');
// Route::get('User/edita/{id}', 'UserController@edita');
// Route::get('User/listaFamiliar/{user_id}', 'UserController@listaFamiliar');
// Route::post('User/ajaxBuscaUsuario', 'UserController@ajaxBuscaUsuario');
// Route::post('User/agregaFamiliar', 'UserController@agregaFamiliar');
// Route::get('User/listaSector/{user_id}', 'UserController@listaSector');
// Route::post('User/ajaxBuscaSector', 'UserController@ajaxBuscaSector');
// Route::post('User/agregaSector', 'UserController@agregaSector');



// SECTORES
Route::get('Sector/distritos', 'SectorController@distritos');
Route::post('Sector/guarda', 'SectorController@guarda');
Route::get('Sector/elimina/{sector_id}', 'SectorController@elimina');
Route::get('Sector/otbs/{distrito_id}', 'SectorController@otbs');
Route::post('Sector/guardaOtb', 'SectorController@guardaOtb');
Route::get('Sector/eliminaOtb/{otb_id}', 'SectorController@eliminaOtb');

// LOCALIZACION
Route::get('localizacion/mapa', 'LocalizacionController@mapa');
Route::get('localizacion/ajaxMapa', 'LocalizacionController@ajaxMapa');

//CLIENTES
Route::get('Cliente/listado', 'ClienteController@listado');
Route::post('Cliente/guarda', 'ClienteController@guarda');
Route::get('Cliente/elimina/{cliente_id}', 'ClienteController@elimina');

//PUBLICIDAD
Route::post('Publicidad/guarda', 'PublicidadController@guarda');
Route::get('Publicidad/listado/{cliente_id}', 'PublicidadController@listado');
Route::get('Publicidad/editPublicidad/{publicidad_id}', 'PublicidadController@editPublicidad');
Route::get('Publicidad/delet/{publicidad_id}', 'PublicidadController@delet');

//PUBLICIDAD
Route::get('Social/eliminaPublicacion/{publicacion_id}', 'SocialController@eliminaPublicacion');



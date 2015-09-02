<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
// */

// Route::get('/', function () {
//     return view('welcome');
// });

$router->get('/Login',['uses'=>'LoginController@index','as'=>'loginIndex']);
$router->post('/login',['uses'=>'LoginController@login','as'=>'login']);
$router->get('/logout',['uses'=>'LoginController@logout','as'=>'logout']);

$router->get('/Registrar',['uses'=>'UserController@index','as'=>'Registrar']);
$router->post('/crearUsuario',['uses'=>'UserController@crearUsuario','as'=>'crearUsuario']);

$router->get('/prueba',function(){
	return Auth::user();
});
$router->get('/',['uses'=>'laminaController@index','as'=>'index']);
$router->get('/getLaminas',['uses'=>'laminaController@getLaminas','as'=>'getLaminas']);
$router->get('/getEditoriales',['uses'=>'laminaController@getEditoriales','as'=>'getEditoriales']);
$router->post('/updateLamina',['uses'=>'laminaController@updateLamina','as'=>'updateLamina']);
$router->post('/createLamina',['uses'=>'laminaController@createLamina','as'=>'createLamina']);
$router->post('/createListLamina',['uses'=>'laminaController@createListLamina','as'=>'createListLamina']);
$router->post('/vender',['uses'=>'laminaController@vender','as'=>'vender']);
$router->post('/deleteLamina',['uses'=>'laminaController@deleteLamina','as'=>'deleteLamina']);



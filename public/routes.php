<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
Route::get('/', function()
{
	return View::make('main');
});
*/
Route::get('/', 'HomeController@showWelcome');
Route::get('/usuario/listaUsuarios', 'UsuarioController@listaUsuarios');
Route::get('/usuario/mudarUsuario/{id}', 'UsuarioController@mudarUsuario');
Route::get('/usuario/getUsuario', 'UsuarioController@getUsuario');

Route::get('/perguntasSemelhantes/{pergunta}', 'HomeController@perguntasSemelhantes');

//Route::resource('contexo', 'ContextosController', array('except'=>array('show')));

Route::resource('contexto', 'ContextoController');
Route::resource('coordenador', 'CoordenadorController');
Route::resource('especialista', 'EspecialistaController');
Route::resource('informacaoRelevante', 'InformacaoRelevanteController');
Route::resource('pergunta', 'PerguntaController');
Route::resource('questionador', 'QuestionadorController');
Route::resource('resposta', 'RespostaController');
Route::resource('usuario', 'UsuarioController');
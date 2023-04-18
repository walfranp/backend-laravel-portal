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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'LoginController@login');
Route::post('user/register', 'LoginController@register');
Route::post('recupera/senha', 'UsuarioController@enviarLinkRecuperarSenha');
Route::post('alterar/senha/token', 'UsuarioController@alterarSenhaPorToken');
Route::post('validar/token', 'UsuarioController@validarToken');

Route::middleware(['auth:api'])->group(function () {

    Route::post('user/logout', 'LoginController@logout');
    Route::get('users/get/{id}', 'UsuarioController@getById');
    Route::post('users/get', 'UsuarioController@get');
    Route::post('user/changePassword', 'UsuarioController@alterarSenha');

    Route::post('gastos/user/get', 'GastosController@gastosMensal');
    Route::post('gastos/user/gastosMensais', 'GastosController@gastosMensais');
    Route::post('gastos/user/top5Convenios', 'GastosController@top5GastosMensais');
    Route::post('gastos/get/ultimos', 'GastosController@getUltimosGastos');
    Route::post('gastosSaude/user/get', 'GastosController@gastosSaude');

    Route::get('convenio/get', 'ConvenioController@getConvenios');
    Route::get('acessos/get', 'LoginController@getLogAcessos');

});

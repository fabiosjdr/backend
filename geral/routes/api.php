<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroContasController;
use App\Http\Controllers\CadastroStandsController;
use App\Http\Controllers\CadastroUsuarioController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MunicipioController;

use Illuminate\Support\Facades\Route;
//use Fabio\Bibliotecas\RouteGenerator\RouteGenerator;

$MODULE = 'geral';

//Route::put('/geral/usuarios/login',[CadastroUsuarioController::class,'login']);
Route::get('geral/login',  [AuthController::class, 'login'])->name('login');
Route::put('geral/login',  [AuthController::class, 'login']);
Route::put('geral/logout', [AuthController::class, 'logout']);
Route::get('geral/me',     [AuthController::class, 'me']);
Route::get('geral/account/{id}',[AuthController::class, 'account']);

//usuarios
// RouteGenerator::gerarRota(Route::class, CadastroUsuarioController::class, 'usuarios', 'INT_USU',$MODULE);

// //contas
// RouteGenerator::gerarRota(Route::class, CadastroContasController::class, 'contas', 'INT_CTA',$MODULE);

// //Estados
// RouteGenerator::gerarRota(Route::class, EstadoController::class, 'estado', 'INT_EST',$MODULE);

// //Municipios
// RouteGenerator::gerarRota(Route::class, MunicipioController::class, 'municipio', 'INT_MUN',$MODULE);

// //Stands
// RouteGenerator::gerarRota(Route::class, CadastroStandsController::class, 'stands', 'INT_MUN',$MODULE);
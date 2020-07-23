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

// RUTA WEB PARA EL INDEX
Route::get('/', 'HomeController@index')->name('index');

// RUTAS WEB DE PACIENTE
Route::get('/Paciente-Listar', 'PacienteController@Index')->name('paciente.index');
Route::get('/Paciente-Crear', 'PacienteController@create')->name('paciente.crear');
Route::post('/Paciente','PacienteController@store')->name('paciente.guardar');

// RUTAS WEB DE PROGRAMACION DE TOMA DE MUESTRAS
Route::get('/Programacion-Toma-Muestra','ProgramacionTomaDeMuestraController@create')->name('programacion.crear');
Route::post('/Buscar-Paciente', 'ProgramacionTomaDeMuestraController@search')->name('programacion.buscarPaciente');
Route::post('/Programacion', 'ProgramacionTomaDeMuestraController@store')->name('programacion.guardar');

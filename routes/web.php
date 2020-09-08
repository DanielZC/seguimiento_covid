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

// RUTA WEB DE PROGRAMACION DE TOMA DE MUESTRAS
Route::get('/Programacion-Toma-Muestra','ProgramacionTomaDeMuestraController@create')->name('programacion.crear');

// RUTAS WEB DE PROGRAMACION DE TOMA DE MUESTRAS CON RESPONSE JSON
Route::post('/Programacion-guardar-fecha-programacion/json', 'ProgramacionTomaDeMuestraController@store')->name('programacion.guardar');
Route::post('/Programacion-buscar-paciente/json', 'ProgramacionTomaDeMuestraController@search')->name('programacion.buscarPaciente');
Route::post('/programacion-buscar-fecha-programacion/json', 'ProgramacionTomaDeMuestraController@fechaRealizacion')->name('programacion.buscarFechaProgramacion');
Route::put('/programacion-ingresar-fecha-realizacion/json', 'ProgramacionTomaDeMuestraController@ingresarFechaRealizacion')->name('programacion.ingresarFechaRealizacion');
Route::post('/programacion-buscar-paciente-ingresar-resultado/json', 'ProgramacionTomaDeMuestraController@buscarPacienteIngresarResultado')->name('programacion.buscarPacienteResultado');
Route::post('/programacion-ingresar-resultado/json', 'ProgramacionTomaDeMuestraController@ingresarFechaRealizacion')->name('programacion.ingresarFechaRealizacion');
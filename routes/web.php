<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\etiquetas;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('api/personas', [PersonasController::class, 'index']);
Route::get('api/detallePersona/{id}', [PersonasController::class, 'show']);
Route::get('api/etiquetas', [etiquetas::class, 'index']);

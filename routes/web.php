<?php

use App\Http\Controllers\ResumenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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

Route::resource('almacen/categoria', 'CategoriaController');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/resumenes', [ResumenController::class, 'guardarResumen']); // Guardar un resumen
Route::get('/resumenes', [ResumenController::class, 'listarResumenes']); // Listar resúmenes

Route::get('/resumen', [ResumenController::class, 'mostrarFormulario'])->name('formResumen');
Route::post('/resumen', [ResumenController::class, 'generarResumen'])->name('generarResumen');

Route::get('/autores', [AutoresController::class, 'mostrarFormulario'])->name('formResumen');
Route::post('/autores', [AutoresController::class, 'generarResumen'])->name('generarResumen');

Route::get('/noticias', [NewsController::class, 'index'])->name('noticias.index');
Route::get('/noticias/categoria/{categoria}'
, [NewsController::class, 'porCategoria'])->name('noticias.categoria');
Route::get('/noticias/scrape', [NewsController::class, 'scrape'])->name('noticias.scrape');
Route::get('/test-scraping', [NewsController::class, 'test'])->name('noticias.test');

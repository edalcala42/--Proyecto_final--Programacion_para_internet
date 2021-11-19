<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GeneroController;
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

Route::get('/', function(){
    #return view('welcome');
    return view('index_juegos');
})->name('main_page');

Route::get('/about', function(){
    return view('about');
})->name('about_page');

Route::get('/hello', function () {
    return view('hola');
});

Route::resource('juegos', JuegoController::class);
Route::get('enviar-correo/{juego}', [JuegoController::Class, 'enviarJuego'])->name('enviar-correo');
Route::get('store-comentario/{juego}', [JuegoController::class, 'storeComentario'])->name('store-comentario');
Route::get('upload-More-Files/{juego}', [JuegoController::class, 'uploadMoreFiles'])->name('upload-More-Files');
Route::post('store-More-Files/{juego}', [JuegoController::class, 'storeMoreFiles'])->name('store-More-Files');

Route::resource('blogs', BlogController::class);
Route::get('store-comentario2/{blog}', [BlogController::class, 'storeComentario2'])->name('store-comentario2');

Route::resource('generos', GeneroController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

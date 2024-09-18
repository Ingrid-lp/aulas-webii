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

Route::get('/', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::resource('/autor', 'App\Http\Controllers\AutorController');
Route::resource('/livro', 'App\Http\Controllers\LivroController');
Route::resource('/editora', 'App\Http\Controllers\EditoraController');
Route::get('/report/autors/{autor_id}', 'App\Http\Controllers\AutorController@report')->name('autor.report');
Route::get('/graph/autors', 'App\Http\Controllers\AutorController@graph')->name('autor.graph');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

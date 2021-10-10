<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListarController;

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
})->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/listar', [ListarController::class, 'index'])->middleware('auth');
Route::post('/home/submit', [HomeController::class, 'formSubmit']);
Route::delete('/deletar/all', [HomeController::class, 'destroyAll'])->middleware('auth');
Route::delete('/deletar/{id}', [HomeController::class, 'destroy'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
Route::get('/search', [App\Http\Controllers\UserController::class, 'search'])->name('search');

Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update');

Route::delete('/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete');
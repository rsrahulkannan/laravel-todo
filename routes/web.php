<?php

use App\Http\Controllers\TodoController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/todo')->as('todo.')->group(function() {
    Route::get('', [TodoController::class, 'index'])->name('index');
    Route::get('/create', [TodoController::class, 'create'])->name('create');
    Route::post('/store', [TodoController::class, 'store'])->name('store');
    Route::get('/{id}', [TodoController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [TodoController::class, 'edit'])->name('edit');
    Route::put('/update', [TodoController::class, 'update'])->name('update');
    Route::delete('/delete', [TodoController::class, 'delete'])->name('delete');
});
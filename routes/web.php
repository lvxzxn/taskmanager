<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // Importe o controlador de tarefas
use App\Http\Controllers\HomeController; // Importe o controlador home

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rota para a página inicial
Route::get('/', function () {
    return view('index');
});

// Rotas de autenticação
Auth::routes();

// Editar Task
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

// Obter detalhes de uma task
        Route::get('/tasks/{id}', 'TaskController@show')->name('tasks.show');

// Rota para a página home
Route::get('/home', [HomeController::class, 'index'])->name('home');


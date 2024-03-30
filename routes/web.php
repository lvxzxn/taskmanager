<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // Importe o controlador de tarefas
use App\Http\Controllers\HomeController; // Importe o controlador home
use Illuminate\Support\Facades\Auth;

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

// Rotas de Autenticação
    Auth::routes();

// Rota para a página inicial
Route::get('/', function () {
    return view('index');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Editar Task View
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

// Obter detalhes de uma task
Route::get('/tasks/{id}', 'TaskController@show')->name('tasks.show');

// Ações
    // Criar uma Task
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Editar uma Task
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    // Deletar uma Task
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
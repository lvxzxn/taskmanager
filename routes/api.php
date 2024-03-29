<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('tasks', 'TaskController');

Route::get('/v2/tasks', 'TaskController@apiIndex');
Route::get('/v2/tasks/{id}', 'TaskController@apiShow'); 
Route::post('/v2/tasks', 'TaskController@apiStore');
Route::put('/v2/tasks/{id}', 'TaskController@apiUpdate');
Route::delete('/v2/tasks/{id}', 'TaskController@apiDestroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

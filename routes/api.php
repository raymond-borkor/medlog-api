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

Route::group(['middleware' => ['auth:api']], function (){
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    //Project routes
    Route::get('/projects/list', [\App\Http\Controllers\ProjectsController::class, 'index']);
    Route::post('/projects/save', [\App\Http\Controllers\ProjectsController::class, 'store']);
    Route::put('/projects/update/{id}', [\App\Http\Controllers\ProjectsController::class, 'update']);
    Route::delete('/projects/delete/{id}', [\App\Http\Controllers\ProjectsController::class, 'destroy']);
    //request routs
    Route::get('requests/list', [\App\Http\Controllers\OrderController::class, 'index']);
    Route::post('requests/save', [\App\Http\Controllers\OrderController::class, 'store']);
    Route::put('requests/update/{id}', [\App\Http\Controllers\OrderController::class, 'update']);
    Route::delete('requests/delete/{id}',[\App\Http\Controllers\OrderController::class, 'destroy']);
});

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
Route::get('/test/{id}', [\App\Http\Controllers\OrderController::class, 'test']);

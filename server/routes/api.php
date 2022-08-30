<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\TodoListController;
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

/*
|-------------------------------------------------------------------------------
| Public API Routes
|-------------------------------------------------------------------------------
| URL: /api
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
|-------------------------------------------------------------------------------
| Authenticated API Routes
|-------------------------------------------------------------------------------
| URL: /api
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('todolists')->group(function() {
        Route::get('/', [TodoListController::class, 'index']);
        Route::post('/', [TodoListController::class, 'store']);
        Route::delete('/{todolist}', [TodoListController::class, 'destroy']);
    
        Route::get('/{todolist}/todos', [TodoController::class, 'index']);
        Route::post('/{todolist}/todos', [TodoController::class, 'store']);
        Route::put('/{todolist}/todos/{todo}', [TodoController::class, 'completed']);
        Route::delete('/{todolist}/todos/{todo}', [TodoController::class, 'destroy']);

    });
});

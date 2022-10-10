<?php

use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['secretKey'])->group(function () {

    Route::prefix('categorias')->group(function () {
        Route::get('/', [CategoriaController::class, 'index']);
        Route::get('/activa', [CategoriaController::class, 'getActivas']);
        Route::get('/top', [CategoriaController::class, 'top']);
        Route::post('/', [CategoriaController::class, 'store']);
        Route::put('/{id}', [CategoriaController::class, 'update']);
        Route::delete('/{id}', [CategoriaController::class, 'destroy']);
    });
    Route::prefix('marcas')->group(function () {
        Route::get('/', [MarcaController::class, 'index']);
        Route::post('/', [MarcaController::class, 'store']);
        Route::put('/{id}', [MarcaController::class, 'update']);
        Route::delete('/{id}', [MarcaController::class, 'destroy']);
    });
    Route::prefix('productos')->group(function () {
        Route::get('/', [ProductoController::class, 'index']);
        Route::get('/activo', [ProductoController::class, 'getProductActivos']);
        Route::get('/top', [ProductoController::class, 'getProductoTop']);
        Route::get('/{id}', [ProductoController::class, 'show']);
        Route::get('/categoria/{id}', [ProductoController::class, 'getProductoCategoria']);
        Route::post('/', [ProductoController::class, 'store']);
        Route::post('/update/{id}', [ProductoController::class, 'update']);
        Route::delete('/{id}', [ProductoController::class, 'destroy']);
    });
    Route::prefix('bodegas')->group(function () {
        Route::get('/', [BodegaController::class, 'index']);
        Route::post('/', [BodegaController::class, 'store']);
        Route::put('/{id}', [BodegaController::class, 'update']);
        Route::delete('/{id}', [BodegaController::class, 'destroy']);
    });
});

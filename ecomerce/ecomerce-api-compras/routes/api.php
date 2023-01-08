<?php

use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CargoController;
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
        Route::get('/activos', [ProductoController::class, 'getProductActivos']);
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
    Route::prefix('empresas')->group( function (){
        Route::get('/' ,[EmpresaController::class,'index']);
        Route::post('/' ,[EmpresaController::class,'store']);
        Route::put('/{id}' ,[EmpresaController::class,'update']);
        Route::delete('/{id}' ,[EmpresaController::class,'destroy']);
    });
    Route::prefix('empleado')->group( function (){
        Route::get('/' ,[EmpleadoController::class,'index']);
        Route::get('/{id}' ,[EmpleadoController::class,'show']);
        Route::post('/',[EmpleadoController::class,'store']);
        Route::put('/{id}' ,[EmpleadoController::class,'update']);
        Route::delete('/{id}' ,[EmpleadoController::class,'destroy']);
    });
        Route::prefix('cargo')->group( function (){
        Route::get('/' ,[CargoController::class,'index']);
        Route::get('/{id}' ,[CargoController::class,'show']);
        Route::post('/',[CargoController::class,'store']);
        Route::put('/{id}' ,[CargoController::class,'update']);
        Route::delete('/{id}' ,[CargoController::class,'destroy']);
    });


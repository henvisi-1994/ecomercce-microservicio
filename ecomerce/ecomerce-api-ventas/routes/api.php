<?php

use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\DirecionController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\TipoIdentificacionController;
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
Route::prefix('pais')->group(function () {
    Route::get('/', [PaisController::class, 'index']);
    Route::post('/', [PaisController::class, 'store']);
    Route::put('/{id}', [PaisController::class, 'update']);
    Route::delete('/{id}', [PaisController::class, 'destroy']);
});
Route::prefix('provincia')->group(function () {
    Route::get('/', [ProvinciaController::class, 'index']);
    Route::post('/', [ProvinciaController::class, 'store']);
    Route::put('/{id}', [ProvinciaController::class, 'update']);
    Route::delete('/{id}', [ProvinciaController::class, 'destroy']);
});

Route::prefix('ciudad')->group(function () {
    Route::get('/', [CiudadController::class, 'index']);
    Route::post('/', [CiudadController::class, 'store']);
    Route::put('/{id}', [CiudadController::class, 'update']);
    Route::delete('/{id}', [CiudadController::class, 'destroy']);
});
Route::prefix('direccion')->group(function () {
    Route::get('/', [DirecionController::class, 'index']);
    Route::post('/', [DirecionController::class, 'store']);
    Route::put('/{id}', [DirecionController::class, 'update']);
    Route::delete('/{id}', [DirecionController::class, 'destroy']);
});
Route::prefix('persona')->group(function () {
    Route::get('/', [PersonaController::class, 'index']);
    Route::get('/{id}', [PersonaController::class, 'show']);
    Route::post('', [PersonaController::class, 'store']);
    Route::put('/{id}', [PersonaController::class, 'update']);
});
Route::prefix('cliente')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);
    Route::get('/{id}', [ClienteController::class, 'show']);
    Route::post('/', [ClienteController::class, 'store']);
    Route::put('/{id}', [ClienteController::class, 'update']);
    Route::delete('/{id}', [ClienteController::class, 'destroy']);
});
Route::prefix('pedido')->group(function () {
    Route::get('/', [PedidoController::class, 'index']);
    Route::get('/{id}', [PedidoController::class, 'show']);
    Route::post('/', [PedidoController::class, 'store']);
    Route::put('/enviar/{id}', [PedidoController::class, 'enviar']);
    Route::put('/pagar/{id}', [PedidoController::class, 'Pagar']);
    Route::get('/status', [PedidoController::class, 'status']);
    Route::delete('/{id}', [PedidoController::class, 'destroy']);
    Route::post('success', [PedidoController::class, 'success'])->name('success.payment');
    Route::prefix('detalle')->group(function () {
        Route::get('admin/{id}', [DetallePedidoController::class, 'getPedido']);
        Route::get('/{id}', [DetallePedidoController::class, 'show']);
        Route::post('/', [DetallePedidoController::class, 'store']);
        Route::delete('/{id}', [DetallePedidoController::class, 'destroy']);
    });
});
Route::prefix('formaPago')->group(function () {
    Route::get('/', [FormaPagoController::class, 'index']);
});
Route::prefix('identificaciones')->group(function () {
    Route::get('/', [TipoIdentificacionController::class, 'index']);
});
Route::prefix('provincia')->group(function () {
    Route::get('/', [ProvinciaController::class, 'index']);
    Route::post('/', [ProvinciaController::class, 'store']);
    Route::put('/{id}', [ProvinciaController::class, 'update']);
    Route::delete('/{id}', [ProvinciaController::class, 'destroy']);
});

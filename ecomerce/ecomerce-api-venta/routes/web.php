<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\DirecionController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\TipoIdentificacionController;
use App\Http\Controllers\UserController;
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
Route::prefix('productos')->group( function (){
    Route::get('/' ,[ProductoController::class,'index']);
    Route::get('/activo' ,[ProductoController::class,'getProductActivos']);
    Route::get('/top' ,[ProductoController::class,'getProductoTop']);
    Route::get('/{id}' ,[ProductoController::class,'show']);
    Route::get('/categoria/{id}' ,[ProductoController::class,'getProductoCategoria']);
    Route::post('/' ,[ProductoController::class,'store']);
    Route::post('/update/{id}' ,[ProductoController::class,'update']);
    Route::delete('/{id}' ,[ProductoController::class,'destroy']);
});
Route::prefix('categorias')->group( function (){
    Route::get('/' ,[CategoriaController::class,'index']);
    Route::get('/activa' ,[CategoriaController::class,'getActivas']);
    Route::get('/top' ,[CategoriaController::class,'top']);
    Route::post('/' ,[CategoriaController::class,'store']);
    Route::put('/{id}' ,[CategoriaController::class,'update']);
    Route::delete('/{id}' ,[CategoriaController::class,'destroy']);
});
Route::prefix('marcas')->group( function (){
    Route::get('/' ,[MarcaController::class,'index']);
    Route::post('/' ,[MarcaController::class,'store']);
    Route::put('/{id}' ,[MarcaController::class,'update']);
    Route::delete('/{id}' ,[MarcaController::class,'destroy']);
});
Route::prefix('empresas')->group( function (){
    Route::get('/' ,[EmpresaController::class,'index']);
    Route::post('/' ,[EmpresaController::class,'store']);
    Route::put('/{id}' ,[EmpresaController::class,'update']);
    Route::delete('/{id}' ,[EmpresaController::class,'destroy']);
});
Route::prefix('pais')->group( function (){
    Route::get('/' ,[PaisController::class,'index']);
    Route::post('/' ,[PaisController::class,'store']);
    Route::put('/{id}' ,[PaisController::class,'update']);
    Route::delete('/{id}' ,[PaisController::class,'destroy']);
});
Route::prefix('provincia')->group( function (){
    Route::get('/' ,[ProvinciaController::class,'index']);
    Route::post('/' ,[ProvinciaController::class,'store']);
    Route::put('/{id}' ,[ProvinciaController::class,'update']);
    Route::delete('/{id}' ,[ProvinciaController::class,'destroy']);
});

Route::prefix('ciudad')->group( function (){
    Route::get('/' ,[CiudadController::class,'index']);
    Route::post('/' ,[CiudadController::class,'store']);
    Route::put('/{id}' ,[CiudadController::class,'update']);
    Route::delete('/{id}' ,[CiudadController::class,'destroy']);
});
Route::prefix('direccion')->group( function (){
    Route::get('/' ,[DirecionController::class,'index']);
    Route::post('/' ,[DirecionController::class,'store']);
    Route::put('/{id}' ,[DirecionController::class,'update']);
    Route::delete('/{id}' ,[DirecionController::class,'destroy']);
});
Route::prefix('usuario')->group( function (){
    Route::get('/' ,[UserController::class,'index']);
    Route::post('/' ,[UserController::class,'store']);
    Route::put('/{id}' ,[UserController::class,'update']);
    Route::delete('/{id}' ,[UserController::class,'destroy']);
});
Route::prefix('cargos')->group( function (){
    Route::get('/' ,[CargoController::class,'index']);
    Route::post('/' ,[CargoController::class,'store']);
    Route::put('/{id}' ,[CargoController::class,'update']);
    Route::delete('/{id}' ,[CargoController::class,'destroy']);
});
Route::prefix('tipoIdent')->group( function (){
    Route::get('/' ,[TipoIdentificacionController::class,'index']);
    Route::post('/' ,[TipoIdentificacionController::class,'store']);
    Route::put('/{id}' ,[TipoIdentificacionController::class,'update']);
    Route::delete('/{id}' ,[TipoIdentificacionController::class,'destroy']);
});
Route::prefix('bodegas')->group( function (){
    Route::get('/' ,[BodegaController::class,'index']);
    Route::post('/',[BodegaController::class,'store']);
    Route::put('/{id}' ,[BodegaController::class,'update']);
    Route::delete('/{id}' ,[BodegaController::class,'destroy']);
});
Route::prefix('empleado')->group( function (){
    Route::get('/' ,[EmpleadoController::class,'index']);
    Route::post('/',[EmpleadoController::class,'store']);
    Route::put('/{id}' ,[EmpleadoController::class,'update']);
    Route::delete('/{id}' ,[EmpleadoController::class,'destroy']);
});
Route::post('persona',[PersonaController::class,'store']);
Route::prefix('cliente')->group( function (){
    Route::get('/' ,[ClienteController::class,'index']);
    Route::post('/',[ClienteController::class,'store']);
    Route::put('/{id}' ,[ClienteController::class,'update']);
    Route::delete('/{id}' ,[ClienteController::class,'destroy']);
});
Route::prefix('pedido')->group( function (){
    Route::get('/' ,[PedidoController::class,'index']);
    Route::get('/{id}' ,[PedidoController::class,'show']);
    Route::post('/',[PedidoController::class,'store']);
    Route::put('/enviar/{id}',[PedidoController::class,'enviar']);
    Route::put('/pagar/{id}',[PedidoController::class,'Pagar']);
    Route::get('/status',[PedidoController::class,'status']);
    Route::delete('/{id}' ,[PedidoController::class,'destroy']);
    Route::prefix('detalle')->group( function (){
        Route::get('admin/{id}' ,[DetallePedidoController::class,'getPedido']);
        Route::get('/{id}' ,[DetallePedidoController::class,'show']);
        Route::post('/',[DetallePedidoController::class,'store']);
        Route::delete('/{id}',[DetallePedidoController::class,'destroy']);
    });
});
Route::prefix('formaPago')->group( function (){
    Route::get('/',[FormaPagoController::class,'index']);
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

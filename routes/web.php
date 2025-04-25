<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route as RouteFacade;


use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\MedidaController;
use App\Http\Controllers\PermissionController;

// Rutas para administradores (acceso completo)
/* Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('productos', ProductoController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('medidas', MedidaController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('usuarios', UserController::class);
    Route::resource('permissions', PermissionController::class);
    // Agrega aquí todas las rutas para los demás controladores
}); */

// Rutas para usuarios (acceso limitado)
/* Route::middleware(['auth', 'role:usuario'])->group(function () {
    Route::resource('clientes', ClienteController::class)->only(['index', 'show','create','store','edit','update']);
    Route::resource('ventas', VentaController::class)->only(['index', 'show','create','store','edit','update']);
    Route::resource('productos', ProductoController::class)->only(['index', 'show']);
    Route::resource('compras', CompraController::class)->only(['index', 'show','create','store','edit','update']);
    // Define aquí las rutas específicas para los otros módulos
}); */

// Rutas que cualquier usuario autenticado puede acceder
Route::middleware(['auth'])->group(function () {
    // Rutas comunes para todos los usuarios autenticados
    Route::get('/home', 'HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['register'=>false]);

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });

   
    Route::resource('/categorias', CategoriaController::class)->middleware('can:categorias');
    Route::resource('/proveedores', ProveedorController::class)->middleware('can:proveedores');
    Route::resource('/productos', ProductoController::class)->middleware('can:productos');
    Route::resource('/pedidos', PedidoController::class)->middleware('can:pedidos');
    Route::resource('/ventas', \App\Http\Controllers\VentaController::class)->middleware('can:ventas');
    Route::resource('/clientes', \App\Http\Controllers\ClienteController::class)->middleware('can:clientes');
    Route::resource('/medidas', \App\Http\Controllers\MedidaController::class)->middleware('can:medidas');
    Route::resource('/compras', \App\Http\Controllers\CompraController::class)->middleware('can:compras');
    Route::resource('/users', UserController::class)->middleware('can:users');
    //detalles  de mis ventas :)rutas
    Route::get('/ventas/{id}/detalle', [VentaController::class, 'obtenerDetallesVenta']);
    Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');



    /* Route::resource('/permission', PermissionController::class); */
    // Rutas adicionales
    Route::get('/admin', [AdminController::class, 'index'])->name('index')->middleware('can:index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('can:home');
    Route::get('/', [AdminController::class, 'index']);

});

Route::resource('/roles', \App\Http\Controllers\RoleController::class)->middleware('can:roles');

Route::resource('/permisos', \App\Http\Controllers\PermissionController::class)->middleware('can:permisos');
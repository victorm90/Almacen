<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ComprasController;
use App\Http\Controllers\DetalleVentasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ReportesProductosController;
use App\Http\Controllers\UsuariosController;

Route::get('crear-admin', [AuthController::class, 'crearAdmin']);

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/logear', [AuthController::class, 'logear'])->name('logear');

Route::middleware("auth")->group(function () {
    Route::get('/home', [Dashboard::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('ventas')->middleware('auth')->group(function () {
    Route::get('/nueva-venta', [VentasController::class, 'index'])->name('ventas-nueva');
    Route::get('/agregar-carrito/{id_producto}', [VentasController::class, 'agregar_carrito'])->name('ventas.agregar.carrito');
    Route::get('/borrar-carrito', [VentasController::class, 'borrar_carrito'])->name('ventas.borrar.carrito');
    Route::get('/quitar-carrito/{id_producto}', [VentasController::class, 'quitar_carrito'])->name('ventas.quitar.carrito');
    Route::post('/vender', [VentasController::class, 'vender'])->name('ventas.vender');
});

Route::prefix('detalle')->middleware('auth')->group(function () {
    Route::get('/detalle-venta', [DetalleVentasController::class, 'index'])->name('detalle-venta');
    Route::get('/vista-detalle/{id_venta}', [DetalleVentasController::class, 'vista_detalle'])->name('detalle.vista.detalle');
    Route::delete('/revocar/{id_venta}', [DetalleVentasController::class, 'revocar'])->name('detalle.revocar');
    Route::get('/ticket/{id_venta}', [DetalleVentasController::class, 'generarTicket'])->name('detalle.ticket');
});

Route::prefix('categorias')->middleware('auth', 'Checkrol:admin')->group(function () {
    Route::get('/', [CategoriasController::class, 'index'])->name('categorias');
    Route::get('/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/store', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/show/{id}', [CategoriasController::class, 'show'])->name('categorias.show');
    Route::delete('/destroy/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/edit/{id}', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::put('/update/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
});

Route::prefix('productos')->middleware('auth', 'Checkrol:admin')->group(function () {
    Route::get('/', [ProductosController::class, 'index'])->name('productos');
    Route::get('/create', [ProductosController::class, 'create'])->name('productos.create');
    Route::post('/store', [ProductosController::class, 'store'])->name('productos.store');
    Route::get('/edit/{id}', [ProductosController::class, 'edit'])->name('productos.edit');
    Route::put('/update/{id}', [ProductosController::class, 'update'])->name('productos.update');
    Route::get('/show/{id}', [ProductosController::class, 'show'])->name('productos.show');
    Route::delete('/destroy/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
    Route::get('/cambiar-estado/{id}/{estado}', [ProductosController::class, 'estado'])->name('productos.estado');
    Route::get('/show-image/{id}', [ProductosController::class, 'show_image'])->name('productos.show.image');
    Route::put('/update-image/{id}', [ProductosController::class, 'update_image'])->name('productos.update.image');
});

Route::prefix('reportes_productos')->middleware('auth')->group(function(){
    Route::get('/', [ReportesProductosController::class, 'index'])->name('reportes_productos');
    Route::get('/falta-stock', [ReportesProductosController::class, 'falta_stock'])->name('reportes_productos.falta_stock');
});

Route::prefix('clientes')->middleware('auth')->group(function () {
    Route::get('/', [ClientesController::class, 'index'])->name('clientes');
});

Route::prefix('proveedores')->middleware('auth','Checkrol:admin')->group(function(){
    Route::get('/', [ProveedoresController::class, 'index'])->name('proveedores');
    Route::get('/create', [ProveedoresController::class, 'create'])->name('proveedores.create');
    Route::post('/store', [ProveedoresController::class, 'store'])->name('proveedores.store');
    Route::get('/edit/{id}', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
    Route::put('/update/{id}', [ProveedoresController::class, 'update'])->name('proveedores.update');
    Route::get('/show/{id}', [ProveedoresController::class, 'show'])->name('proveedores.show');
    Route::delete('/destroy/{id}', [ProveedoresController::class, 'destroy'])->name('proveedores.destroy');
});

Route::prefix('usuarios')->middleware('auth')->group(function () {
    Route::get('/', [UsuariosController::class, 'index'])->name('usuarios');
    Route::get('/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/store', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/edit/{id}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/update/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::get('/tbody', [UsuariosController::class, 'tbody'])->name('usuarios.tbody');
    Route::get('/cambiar-estado/{id}/{estado}', [UsuariosController::class, 'estado'])->name('usuarios.estado');
    Route::get('/cambiar-password/{id}/{password}', [UsuariosController::class, 'cambio_password'])->name('usuarios.password');
});

Route::prefix('compras')->middleware('auth','Checkrol:admin')->group(function () {
    Route::get('/', [ComprasController::class, 'index'])->name('compras');
    Route::get('/create/{id_producto}', [ComprasController::class, 'create'])->name('compras.create');
    Route::post('/store', [ComprasController::class, 'store'])->name('compras.store');
    Route::get('/edit/{id}', [ComprasController::class, 'edit'])->name('compras.edit');
    Route::put('/update/{id}', [ComprasController::class, 'update'])->name('compras.update');
    Route::get('/show/{id}', [ComprasController::class, 'show'])->name('compras.show');
    Route::delete('/destroy/{id}', [ComprasController::class, 'destroy'])->name('compras.destroy');
});
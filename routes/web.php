<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ventasController;
use App\Http\Controllers\comprasController;
use App\Http\Controllers\reportesController;
use App\Http\Controllers\estimacionesController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [IndexController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('log_out', 'Auth\LoginController@logout')->name('log_out');
Route::get('log_out', [AuthenticatedSessionController::class, 'destroy'])->name('log_out');

Route::group(['prefix' => 'panel/administrativo', 'middleware' => 'auth'], function () {
    
    /////ventas/////
    Route::get('ventas/index', [ventasController::class, 'index'])->name('ventas.index');
    Route::get('ventas/detalle/{id}', [ventasController::class, 'detail'])->name('ventas.detalle');

    /////compras/////
    Route::get('compras/index', [comprasController::class, 'index'])->name('compras.index');
    Route::get('compras/detalle/{id}', [comprasController::class, 'detail'])->name('compras.detalle');

    /////Reportes/////
    Route::get('reportes/compras', [reportesController::class, 'view_compras'])->name('reportes.compras');
    Route::post('reportes/compras/search', [reportesController::class, 'search_report_compras'])->name('reportes.compras.search');
    Route::get('reportes/ventas', [reportesController::class, 'view_ventas'])->name('reportes.ventas');
    Route::post('reportes/ventas/search', [reportesController::class, 'search_report_ventas'])->name('reportes.ventas.search');
    Route::get('reportes/inventario', [reportesController::class, 'inventario'])->name('reportes.inventario');

    ///////Estimaciones//////
    Route::get('estimaciones/compras', [estimacionesController::class, 'compras_index'])->name('estimaciones.compras');
    Route::get('estimaciones/compras/getInfoProductos', [estimacionesController::class, 'getInfoProductos'])->name('estimaciones.compras.getInfoProductos');
    Route::get('estimaciones/compras/getInfoVetasProducts', [estimacionesController::class, 'getInfoVetasProducts'])->name('estimaciones.compras.getInfoVetasProducts');

});

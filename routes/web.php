<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/** ============> ENDPOINTS SIN AUTENTICACION <============================= */

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::get('/formato', [HomeController::class, 'formato']);

Auth::routes();

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');

    Route::get('/formas_de_pago', [TipoPagoController::class, 'index'])->name('formas_pago');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

    Route::get('/ordenes_compra', [OrdenCompraController::class, 'index'])->name('ordenes_compra');
    
    Route::get('/ordenes_compra/subir-facturas/{orden}', [OrdenCompraController::class, 'subirFacturas'])
        ->name('subirFacturas');

    Route::post('/ordenes_compra/subir-facturas/{orden}', [OrdenCompraController::class, 'subirFacturasPOST'])
        ->name('subirFacturasPOST');

    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos');

});



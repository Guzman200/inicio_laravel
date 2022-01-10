<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Catalogos\CategoriaController;
use App\Http\Controllers\Catalogos\ClienteController;
use App\Http\Controllers\CrearVentaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/** ============> ENDPOINTS SIN AUTENTICACION <============================= */

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');


Auth::routes();

/** ============> ENDPOINTS CON AUTENTICACION <============================= */
Route::group(['middleware' => 'auth:sanctum'], function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores');

    Route::get('/formas_de_pago', [TipoPagoController::class, 'index'])->name('formas_pago');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

    Route::get('/ordenes_compra', [OrdenCompraController::class, 'index'])->name('ordenes_compra');

    Route::get('/pagos', [PagoController::class, 'index'])->name('pagos');

    Route::get('/sucursales', [SucursalController::class, 'index'])->name('sucursales');

    Route::get('/productos', [ProductoController::class, 'index'])->name('productos');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');

    // orden de compra
    Route::prefix('ventas')->group(function () {


        Route::get('nueva', [CrearVentaController::class, 'index'])
            ->name('crearVenta');



    });


    // orden de compra
    Route::prefix('ordenes_compra')->group(function () {


        Route::get('subir-facturas/{orden}', [OrdenCompraController::class, 'subirFacturas'])
            ->name('subirFacturas');

        Route::post('subir-facturas/{orden}', [OrdenCompraController::class, 'subirFacturasPOST'])
            ->name('subirFacturasPOST');

        Route::get('descargar-facturas/{factura}', [FacturaController::class, 'descargarFactura'])
            ->name('descargarFactura');

        Route::get('anio-actual-datos-grafica', [OrdenCompraController::class, 'graficaOrdenDeCompra'])
            ->name('graficaOrdenDeCompra');



    });

    // Rutas de reportes
    Route::prefix('reportes')->group(function(){

        Route::get('/orden-compra/{orden}', [OrdenCompraController::class, 'descargarOrdenCompra']);
    });

   
});

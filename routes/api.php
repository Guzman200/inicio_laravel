<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TransportadorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** =====>  Endpoints sin autenticación <======= */

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);




/** =====>  Endpoints con autenticación <======= */

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::put('/pago/{pago}/marcar-pagado', [PagoController::class, 'cambiarStatusAPagado']);

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});

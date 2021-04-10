<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TransportadorController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Notifications\ResetPassword;
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

    Route::get('/transportadores', [TransportadorController::class, 'index'])->name('transportadores');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');

    Route::get('/materiales', [MaterialController::class, 'index'])->name('materiales');

    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');

});



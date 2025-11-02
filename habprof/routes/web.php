<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clogin\loginController;
use App\Http\Controllers\cdashboard\AlumnoController;

// Página principal (login)
Route::get('/', [loginController::class, 'mostrarLogin'])->name('login.mostrar');

// Validación del login
Route::post('/login', [loginController::class, 'validarLogin'])->name('login.validar');

Route::get('/dashboard', function () {
    return view('dashboard.inicio');
})->middleware('auth')->name('dashboard.inicio');

Route::get('/ingreso', function () {
    return view('funciones.ingreso');
})->name('funciones.ingreso');

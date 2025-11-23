<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredHostController;
use App\Http\Controllers\Auth\RegisteredVolunteerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EditRejectedProfileController;

Route::middleware('checkEnabled')->group(function () {
    //Registros
    Route::get('/registrar-anfitrion', [RegisteredHostController::class, 'create'])->name('register-host.create');
    Route::post('/registrar-anfitrion', [RegisteredHostController::class, 'store'])->name('register-host.store');

    Route::get('/locations/{provinceId}', [RegisteredHostController::class, 'getLocationsByProvince']);

    Route::get('/registrar-voluntario', [RegisteredVolunteerController::class, 'create'])->name('register-volunteer.create');
    Route::post('/registrar-voluntario', [RegisteredVolunteerController::class, 'store'])->name('register-volunteer.store');

    //Login
    Route::get('/iniciar-sesion', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/iniciar-sesion', [AuthenticatedSessionController::class, 'store']);

    //cambiar contraseña olvidada
    Route::get('/cambiar-clave/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/cambiar-clave', [NewPasswordController::class, 'store'])->name('password.store');

    //editar datos de un perfil host rechazado
    Route::get('/perfil/editar-datos/{token}/{email}', [RegisteredHostController::class, 'edit'])->name('edit-rejected-profile');
    Route::put('/perfil/editar-datos/{token}/{email}', [RegisteredHostController::class, 'update'])->name('edit-rejected-profile.update');


    Route::middleware('auth')->group(function () {
        Route::post('/cerrar-sesion', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});

//Recuperar contraseña
Route::get('/clave-olvidada', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/clave-olvidada', [PasswordResetLinkController::class, 'store'])->name('password.email');

Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');

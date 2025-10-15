<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterHostController;
use App\Http\Controllers\Auth\RegisterVolunteerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EditRejectedProfileController;


Route::middleware('checkEnabled')->group(function () {
    //Registros
    Route::get('registrar-anfitrion', [RegisterHostController::class, 'create'])->name('register-host.create');
    Route::post('registrar-anfitrion', [RegisterHostController::class, 'store'])->name('register-host.store');

    Route::get('registrar-voluntario', [RegisterVolunteerController::class, 'create'])->name('register-volunteer.create');
    Route::post('registrar-voluntario', [RegisterVolunteerController::class, 'store'])->name('register-volunteer.store');

    //Login
    Route::get('iniciar-sesion', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('iniciar-sesion', [AuthenticatedSessionController::class, 'store']);

    //Recuperar contraseña
    Route::get('clave-olvidada', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');
    Route::post('clave-olvidada', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    //cambiar contraseña olvidada
    Route::get('cambiar-clave/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    Route::post('cambiar-clave', [NewPasswordController::class, 'store'])
        ->name('password.store');

    //editar datos de un perfil rechazado
    Route::get('perfil/editar-datos/{token}/{email}', [RegisterHostController::class, 'edit'])
        ->name('edit-rejected-profile');
    Route::put('perfil/editar-datos/{token}/{email}', [RegisterHostController::class, 'update'])
        ->name('edit-rejected-profile.update');


    Route::middleware('authCheck')->group(function () {
        Route::post('cerrar-sesion', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        //cambiar pw (ya logueado)
        // Route::get('confirm-clave', [ConfirmablePasswordController::class, 'show'])
        //     ->name('password.confirm');

        // Route::post('confirm-clave', [ConfirmablePasswordController::class, 'store']);

        // Route::put('clave', [PasswordController::class, 'update'])->name('password.update');
    });
});

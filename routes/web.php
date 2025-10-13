<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\RegisterHostController;
use App\Http\Controllers\Auth\RegisterVolunteerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\AdminHostsController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::middleware('checkEnabled')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');

    // Route::get('/dashboard', function () {
    //     return view('Dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    //AUTH
    //vistas de forms de registro
    Route::get('register-host', [RegisterHostController::class, 'create'])->name('register-host.create');
    Route::get('register-volunteer', [RegisterVolunteerController::class, 'create'])->name('register-volunteer.create');

    //llamar a los metodos de creacion de usuario
    Route::post('register-host', [RegisterHostController::class, 'store'])->name('register-host.store');
    Route::post('register-volunteer', [RegisterVolunteerController::class, 'store'])->name('register-volunteer.store');

    //vista login y metodo
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    //recuperar pw
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    //autenticado
    Route::middleware('authCheck')->group(function () {
        Route::get('/admin/lista-verificacion-anfitriones', [AdminHostsController::class, 'verifyHostsList'])
            ->name('lista-verificacion-anfitriones')
            ->middleware('isAdmin');

        Route::get('/admin/verificar-perfil-anfitrion/{id}', [AdminHostsController::class, 'verifyHostProfileById'])
            ->name('verificar-perfil-anfitrion')
            ->middleware('isAdmin');

        Route::put('/admin/verificar-perfil-anfitrion/{id}/aceptar', [AdminHostsController::class, 'acceptHostProfile'])
            ->name('aceptar-perfil-anfitrion')
            ->middleware('isAdmin');

        Route::put('admin/verificar-perfil-anfitrion/{id}/desactivar', [AdminHostsController::class, 'disableHostProfile'])
            ->name('desactivar-perfil-anfitrion')
            ->middleware('isAdmin');

        Route::delete('/admin/verificar-perfil-anfitrion/{id}/rechazar', [AdminHostsController::class, 'rejectHostProfile'])
            ->name('rechazar-perfil-anfitrion')
            ->middleware('isAdmin');

        //modificacion de perfil (por ahora sin modificar)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        //contraseñas
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    });
});

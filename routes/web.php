<?php

use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\RegisterHostController;
use App\Http\Controllers\Auth\RegisterVolunteerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\AdminHostsController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EditRejectedProfileController;

Route::middleware('checkEnabled')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');

    // Route::get('/dashboard', function () {
    //     return view('Dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    //AUTH
    //vistas de forms de registro
    Route::get('register-host', [RegisterHostController::class, 'create'])->name('register-host.create'); //ruta a esp name en ingles
    Route::get('register-volunteer', [RegisterVolunteerController::class, 'create'])->name('register-volunteer.create'); //ruta a esp name en ingles

    //llamar a los metodos de creacion de usuario
    Route::post('register-host', [RegisterHostController::class, 'store'])->name('register-host.store'); //ruta a esp name en ingles
    Route::post('register-volunteer', [RegisterVolunteerController::class, 'store'])->name('register-volunteer.store'); //ruta a esp name en ingles

    //vista login y metodo
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login'); //ruta a esp name en ingles

    Route::post('login', [AuthenticatedSessionController::class, 'store']); //ruta a esp name en ingles

    //recuperar pw
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create']) //cambiar ruta a español pero name en ingles
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store']) //cambiar ruta a español pero name en ingles
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create']) //cambiar ruta a español pero name en ingles
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store']) //cambiar ruta a español pero name en ingles
        ->name('password.store');

    Route::get('/perfil/editar-datos/{token}/{email}', [EditRejectedProfileController::class, 'edit'])
        ->name('edit-rejected-profile');

    Route::put('/perfil/editar-datos/{token}/{email}', [EditRejectedProfileController::class, 'update'])
        ->name('edit-rejected-profile.update');

    //autenticado
    Route::middleware('authCheck')->group(function () {
        Route::get('/admin/lista-verificacion-anfitriones', [AdminHostsController::class, 'verifyHostsList'])
            ->name('lista-verificacion-anfitriones') //cambiar despues a ingles (hace falta cambiarlo en layout)
            ->middleware('isAdmin');

        Route::get('/admin/verificar-perfil-anfitrion/{id}', [AdminHostsController::class, 'verifyHostProfileById'])
            ->name('verify-host-profile')
            ->middleware('isAdmin');

        Route::put('/admin/verificar-perfil-anfitrion/{id}/aceptar', [AdminHostsController::class, 'enableHostProfile'])
            ->name('accept-host-profile')
            ->middleware('isAdmin');

        Route::put('admin/verificar-perfil-anfitrion/{id}/desactivar', [AdminHostsController::class, 'disableHostProfile'])
            ->name('disable-host-profile')
            ->middleware('isAdmin');

        Route::put('/admin/verificar-perfil-anfitrion/{id}/rechazar', [AdminHostsController::class, 'disableHostProfile'])
            ->name('reject-host-profile')
            ->middleware('isAdmin');

        Route::put('/admin/verificar-perfil-anfitrion/{id}/reactivar', [AdminHostsController::class, 'enableHostProfile'])
            ->name('reactivate-host-profile')
            ->middleware('isAdmin');

        Route::delete('/admin/verificar-perfil-anfitrion/{id}/eliminar"', [AdminHostsController::class, 'deleteHostProfile'])
            ->name('delete-host-profile')
            ->middleware('isAdmin');

        Route::put('/admin/verificar-perfil-anfitrion/{id}/pendiente', [AdminHostsController::class, 'setHostProfilePending'])
            ->name('pending-host-profile')
            ->middleware('isAdmin');

            Route::post('/admin/verificar-perfil-anfitrion/{host}/enviar-mail', [AdminHostsController::class, 'sendMailRejectedProfile'])
    ->name('send-mail-rejected-profile')->middleware('isAdmin');

        //modificacion de perfil (por ahora sin modificar)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); //ruta a esp name en ingles
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); //ruta a esp name en ingles
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); //ruta a esp name en ingles

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy']) //ruta a esp name en ingles
            ->name('logout');

        //contraseñas
        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show']) //ruta a esp name en ingles 
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); //ruta a esp name en ingles

        Route::put('password', [PasswordController::class, 'update'])->name('password.update'); //ruta a esp name en ingles
    });
});

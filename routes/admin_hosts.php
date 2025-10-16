<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHostsController;

Route::middleware(['checkEnabled', 'authCheck', 'isAdmin'])->prefix('admin')->group(function () {
        Route::get('/lista-verificacion-anfitriones', [AdminHostsController::class, 'verifyHostsList'])
            ->name('list-verify-hosts');

        Route::get('/verificar-perfil-anfitrion/{id}', [AdminHostsController::class, 'verifyHostProfileById'])
            ->name('verify-host-profile');

        Route::put('/verificar-perfil-anfitrion/{id}/aceptar', [AdminHostsController::class, 'enableHostProfile'])
            ->name('enable-host-profile');

             Route::put('/verificar-perfil-anfitrion/{id}/reactivar', [AdminHostsController::class, 'reenableHostProfile'])
            ->name('reenable-host-profile');

        Route::put('/verificar-perfil-anfitrion/{id}/desactivar', [AdminHostsController::class, 'disableHostProfile'])
            ->name('disable-host-profile');

        Route::delete('/verificar-perfil-anfitrion/{id}/eliminar', [AdminHostsController::class, 'deleteHostProfile'])
            ->name('delete-host-profile');

        Route::put('/verificar-perfil-anfitrion/{id}/pendiente', [AdminHostsController::class, 'setHostProfilePending'])
            ->name('pending-host-profile');

        Route::post('/verificar-perfil-anfitrion/{id}/enviar-mail', [AdminHostsController::class, 'sendMailDisabledProfile'])
            ->name('send-mail-disabled-profile');

        Route::post('/verificar-perfil-anfitrion/{id}/recordatorio', [AdminHostsController::class, 'sendHostRejectedReminder'])
            ->name('send-host-rejected-reminder');
});
?>

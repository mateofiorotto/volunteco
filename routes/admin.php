<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHostsController;

Route::middleware(['checkEnabled', 'authCheck', 'isAdmin'])->prefix('admin')->group(function () {
        Route::get('/anfitriones', [AdminHostsController::class, 'statusHostsList'])
            ->name('hosts-list');

        Route::get('/anfitrion/{id}', [AdminHostsController::class, 'getHostProfileById'])
            ->name('host-profile');

        Route::put('/anfitrion/{id}/aceptar', [AdminHostsController::class, 'enableHostProfile'])
            ->name('enable-host-profile');

             Route::put('/anfitrion/{id}/reactivar', [AdminHostsController::class, 'reenableHostProfile'])
            ->name('reenable-host-profile');

        Route::put('/anfitrion/{id}/desactivar', [AdminHostsController::class, 'disableHostProfile'])
            ->name('disable-host-profile');

        Route::delete('/anfitrion/{id}/eliminar', [AdminHostsController::class, 'deleteHostProfile'])
            ->name('delete-host-profile');

        Route::put('/anfitrion/{id}/pendiente', [AdminHostsController::class, 'setHostProfilePending'])
            ->name('pending-host-profile');

        Route::post('/anfitrion/{id}/enviar-mail', [AdminHostsController::class, 'sendMailDisabledProfile'])
            ->name('send-mail-disabled-profile');

        Route::post('/anfitrion/{id}/enviar-mail-perfil', [AdminHostsController::class, 'sendMailUncompleteProfile'])
            ->name('send-mail-uncomplete-profile');

        Route::post('/verificar-perfil-anfitrion/{id}/recordatorio', [AdminHostsController::class, 'sendHostRejectedReminder'])
            ->name('send-host-rejected-reminder');

        // TODO agregar rutas para ver voluntarios
});
?>

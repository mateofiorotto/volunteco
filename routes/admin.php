<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HostsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\VolunteersController;

Route::middleware(['checkEnabled', 'authCheck', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/anfitriones', [HostsController::class, 'index'])->name('hosts.index');
    Route::get('/anfitriones/{id}', [HostsController::class, 'profile'])->name('hosts.profile');
    Route::put('/anfitriones/{id}/aceptar', [HostsController::class, 'enableHostProfile'])->name('enable-host-profile');
    Route::put('/anfitriones/{id}/reactivar', [HostsController::class, 'reenableHostProfile'])->name('reenable-host-profile');
    Route::put('/anfitriones/{id}/desactivar', [HostsController::class, 'disableHostProfile'])->name('disable-host-profile');
    Route::delete('/anfitriones/{id}/eliminar', [HostsController::class, 'deleteHostProfile'])->name('delete-host-profile');
    Route::put('/anfitriones/{id}/pendiente', [HostsController::class, 'setHostProfilePending'])->name('pending-host-profile');
    Route::post('/anfitriones/{id}/enviar-mail', [HostsController::class, 'sendMailDisabledProfile'])->name('send-mail-disabled-profile');
    Route::post('/verificar-perfil-anfitrion/{id}/recordatorio', [HostsController::class, 'sendHostRejectedReminder'])->name('send-host-rejected-reminder');

    // rutas para ver voluntarios
    Route::get('/voluntarios', [VolunteersController::class, 'index'])->name('volunteers.index');
    Route::get('/voluntarios/{id}', [VolunteersController::class, 'getVolunteerProfileById'])->name('volunteer.profile');
    Route::put('/voluntarios/{id}/reactivar', [VolunteersController::class, 'reenableVolunteerProfile'])->name('reenable-volunteer-profile');
    Route::put('/voluntarios/{id}/desactivar', [VolunteersController::class, 'disableVolunteerProfile'])->name('disable-volunteer-profile');
    Route::delete('/voluntarios/{id}/eliminar', [VolunteersController::class, 'deleteVolunteerProfile'])->name('delete-volunteer-profile');

    // rutas de proyectos
    Route::get('/proyectos', [ProjectsController::class, 'index'])->name('projects.index');
    Route::get('/proyectos/{project}', [ProjectsController::class, 'show'])->name('projects.show');
    Route::delete('/proyectos/{project}/eliminar', [ProjectsController::class, 'deleteProject'])->name('projects.delete');

});

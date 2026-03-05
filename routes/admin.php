<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HostsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\VolunteersController;
use App\Http\Controllers\Admin\ProjectTypesController;
use App\Http\Controllers\Admin\ConditionsController;

Route::middleware(['checkEnabled', 'auth', 'CheckRole:admin'])->prefix('admin')->name('admin.')->group(function () {
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
    Route::post('/proyectos/{project}', [ProjectsController::class, 'disabled'])->name('projects.disabled');
    Route::delete('/proyectos/{project}/eliminar', [ProjectsController::class, 'delete'])->name('projects.delete');

    // rutas para condiciones
    // Rutas para condiciones
    Route::get('/condiciones', [ConditionsController::class, 'index'])->name('conditions.index');
    Route::get('/condiciones/crear', [ConditionsController::class, 'create'])->name('conditions.create');
    Route::post('/condiciones', [ConditionsController::class, 'store'])->name('conditions.store');
    Route::get('/condiciones/{id}/editar', [ConditionsController::class, 'edit'])->name('conditions.edit');
    Route::put('/condiciones/{id}', [ConditionsController::class, 'update'])->name('conditions.update');
    Route::get('/condiciones/{id}/eliminar', [ConditionsController::class, 'delete'])->name('conditions.delete');
    Route::delete('/condiciones/{id}', [ConditionsController::class, 'destroy'])->name('conditions.destroy');
    // rutas para tipo de proyectos
    Route::get('/tipos-de-proyectos', [ProjectTypesController::class, 'index'])->name('project-types.index');
    Route::get('/tipos-de-proyectos/crear', [ProjectTypesController::class, 'create'])->name('project-types.create');
    Route::post('/tipos-de-proyectos', [ProjectTypesController::class, 'store'])->name('project-types.store');
    Route::get('/tipos-de-proyectos/{id}/editar', [ProjectTypesController::class, 'edit'])->name('project-types.edit');
    Route::put('/tipos-de-proyectos/{id}', [ProjectTypesController::class, 'update'])->name('project-types.update');
    Route::get('/tipos-de-proyectos/{id}/eliminar', [ProjectTypesController::class, 'delete'])->name('project-types.delete');
    Route::delete('/tipos-de-proyectos/{id}', [ProjectTypesController::class, 'destroy'])->name('project-types.destroy');
});

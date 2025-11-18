<?php

use App\Http\Controllers\User\Host\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Host\HostProjectController;
use App\Http\Controllers\User\Host\ProfileController;
use App\Http\Controllers\User\Host\VolunteerController;

Route::middleware(['authCheck', 'isHost', 'checkEnabled'])->prefix('usuario/anfitrion')->name('host.')->group(function () {

    //rutas de perfil + frontend y metodos de HostController (logica de creacion de proyectos, edicion, eliminacion, etc) y HostProfileController (Edicion de perfil)
    /**
     * Proyectos: metodos para vista de proyectos propios (lista), vista de creacion, edicion y eliminacion (puede ser con modal la eliminacion)
     * Tambien, metodos para aceptar y rechazar anfitriones anotados
     */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/mis-proyectos', [HostProjectController::class, 'index'])->name('my-projects.index');
    Route::get('/mis-proyectos/crear', [HostProjectController::class, 'create'])->name('my-projects.create');
    Route::post('/mis-proyectos', [HostProjectController::class, 'store'])->name('my-projects.store');

    Route::get('/mis-proyectos/{id}', [HostProjectController::class, 'show'])->name('my-projects.show');

    Route::get('/mis-proyectos/{id}/editar', [HostProjectController::class, 'edit'])->name('my-projects.edit');
    Route::put('/mis-proyectos/{id}', [HostProjectController::class, 'update'])->name('my-projects.update');
    Route::patch('/mis-proyectos/{id}', [HostProjectController::class, 'updateEnabled'])->name('my-projects.updateEnabled');

    Route::get('/mis-proyectos/{id}/eliminar', [HostProjectController::class, 'delete'])->name('my-projects.delete');
    Route::delete('/mis-proyectos/{id}/eliminar', [HostProjectController::class, 'destroy'])->name('my-projects.destroy');

    //manejar anfitriones inscriptos (aceptar o rechazar)
    Route::put('/mis-proyectos/{projectId}/anfitriones/{volunteerId}/aceptar', [HostProjectController::class, 'acceptVolunteer'])->name('my-projects.accept-volunteer');
    Route::put('/mis-proyectos/{projectId}/anfitriones/{volunteerId}/rechazar', [HostProjectController::class, 'rejectVolunteer'])->name('my-projects.reject-volunteer');

    //edicion de perfil
    Route::get('/mi-perfil', [ProfileController::class, 'myProfile'])->name('my-profile.profile');
    Route::get('/mi-perfil/editar', [ProfileController::class, 'editMyProfile'])->name('my-profile.edit');
    Route::put('/mi-perfil/editar', [ProfileController::class, 'updateMyProfile'])->name('my-profile.update');

    // perfil del voluntario postulado
    Route::get('/voluntario/perfil/{id}', [VolunteerController::class, 'profile'])->name('volunteers.profile');

});

//perfil publico
Route::middleware(['checkEnabled'])->prefix('usuario/anfitrion')->name('hosts.')->group(function () {
    Route::get('/perfil/{id}', [ProfileController::class, 'getProfile'])->name('host-profile');
});

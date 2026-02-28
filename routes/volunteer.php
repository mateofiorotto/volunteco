<?php

use App\Http\Controllers\User\Volunteer\DashboardController;
use App\Http\Controllers\User\Volunteer\ProfileController;
use App\Http\Controllers\User\Volunteer\VolunteerProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Volunteer\HostController;

Route::middleware(['auth', 'CheckRole:volunteer', 'checkEnabled'])->prefix('usuario/voluntario')->name('volunteer.')->group(function () {

    //rutas de perfil + frontend y metodos de VolunteerController (logica de aplicacion a proyectos creados) y VolunteerProfileController (Edicion de perfil)
    /**
     * Proyectos: metodos para vista de proyectos aplicados (lista), desistir de proyectos
     */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/mis-proyectos-aplicados', [VolunteerProjectController::class, 'volunteerAppliedProjects'])->name('projects.applied');

    Route::post('/aplicar-proyecto/{project}', [VolunteerProjectController::class, 'applyProject'])->name('apply-project');
    Route::delete('/desistir-proyecto/{project}', [VolunteerProjectController::class, 'withdrawFromProject'])->name('withdraw-project');
    Route::delete('/cancelar-proyecto/{project}', [VolunteerProjectController::class, 'cancelFromProject'])->name('cancel-project');

    //edicion de perfil
    Route::get('/mi-perfil', [ProfileController::class, 'myProfile'])->name('my-profile.profile');
    Route::get('/mi-perfil/editar', [ProfileController::class, 'editMyProfile'])->name('my-profile.edit');
    Route::put('/mi-perfil/editar', [ProfileController::class, 'updateMyProfile'])->name('my-profile.update');

    // perfil del host donde tiene algun proyecto activo
    Route::get('/anfitrion/perfil/{id}', [HostController::class, 'profile'])->name('hosts.profile');

});

Route::middleware(['checkEnabled'])->prefix('usuario')->name('volunteer.')->group(function () {
    Route::get('/voluntario/perfil/{id}', [ProfileController::class, 'getProfile'])->name('profile');
});

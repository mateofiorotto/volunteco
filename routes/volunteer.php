<?php

use App\Http\Controllers\User\Volunteer\DashboardController;
use App\Http\Controllers\User\Volunteer\ProfileController;
use App\Http\Controllers\User\Volunteer\VolunteerProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['authCheck', 'isVolunteer', 'checkEnabled'])->prefix('usuario/voluntario')->name('volunteer.')->group(function () {

     //rutas de perfil + frontend y metodos de VolunteerController (logica de aplicacion a proyectos creados) y VolunteerProfileController (Edicion de perfil)
    /**
     * Proyectos: metodos para vista de proyectos aplicados (lista), desistir de proyectos
     */
    Route::get('/', [DashboardController::class, 'index'] )->name('dashboard');

    Route::get('/mis-proyectos-aplicados', [VolunteerProjectController::class, 'volunteerAppliedProjects'])->name('projects.applied');

    Route::post('/aplicar-proyecto/{project}', [VolunteerProjectController::class, 'applyProject'])->name('apply-project');
    Route::delete('/desistir-proyecto/{project}', [VolunteerProjectController::class, 'withdrawFromProject'])->name('withdraw-project');

    //edicion de perfil
    Route::get('/mi-perfil', [ProfileController::class, 'show'])->name('my-profile.show');
    Route::get('/mi-perfil/{id}/editar', [ProfileController::class, 'edit'])->name('my-profile.edit');
    Route::put('/mi-perfil/{id}/editar', [ProfileController::class, 'update'])->name('my-profile.update');

});

Route::middleware(['checkEnabled'])->prefix('usuario/voluntario')->name('volunteer.')->group(function () {
    Route::get('/perfil/{id}', [ProfileController::class, 'getProfile'])->name('volunteer-profile');
});

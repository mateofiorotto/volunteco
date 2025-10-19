<?php

use App\Http\Controllers\User\Volunteer\VolunteerProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware(['authCheck'])->prefix('perfil_voluntario')->group(function () {
    
 //rutas de perfil + frontend y metodos de VolunteerController (logica de aplicacion a proyectos creados) y VolunteerProfileController (Edicion de perfil)
    /**
     * Proyectos: metodos para vista de proyectos aplicados (lista), desistir de proyectos
     */
    Route::get('/mis-proyectos-aplicados', [VolunteerProjectController::class, 'volunteerAppliedProjects'])->name('volunteer.applied-projects');
});
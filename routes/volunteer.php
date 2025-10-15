<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProfileController;

Route::middleware(['authCheck'])->prefix('perfil_voluntario')->group(function () {
    
 //rutas de perfil + frontend y metodos de VolunteerController (logica de aplicacion a proyectos creados) y VolunteerProfileController (Edicion de perfil)
});
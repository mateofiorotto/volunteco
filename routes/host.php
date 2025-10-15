<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ProfileController;

Route::middleware(['authCheck'])->prefix('perfil_anfitrion')->group(function () {
    
        //rutas de perfil + frontend y metodos de HostController (logica de creacion de proyectos, edicion, eliminacion, etc) y HostProfileController (Edicion de perfil)
});
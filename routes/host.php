<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Host\HostProjectController;

Route::middleware(['authCheck', 'isHost', 'checkEnabled'])->prefix('anfitriones')->group(function () {

        //rutas de perfil + frontend y metodos de HostController (logica de creacion de proyectos, edicion, eliminacion, etc) y HostProfileController (Edicion de perfil)
        /**
         * Proyectos: metodos para vista de proyectos propios (lista), vista de creacion, edicion y eliminacion (puede ser con modal la eliminacion)
         * Tambien, metodos para aceptar y rechazar anfitriones anotados
         */

        Route::get('/mis-proyectos', [HostProjectController::class, 'index'])->name('my-projects.index');
        //Route::get('/proyectos/{project}', [HostProjectController::class, 'show'])->name('projects.show');

        Route::get('/mis-proyectos/crear', [HostProjectController::class, 'create'])->name('my-projects.create');
        Route::post('/mis-proyectos', [HostProjectController::class, 'store'])->name('my-projects.store');
        
        Route::get('/mis-proyectos/{project}/editar', [HostProjectController::class, 'edit'])->name('my-projects.edit');
        Route::put('/mis-proyectos/{project}', [HostProjectController::class, 'update'])->name('my-projects.update');

        Route::delete('/mis-proyectos/{project}', [HostProjectController::class, 'destroy'])->name('my-projects.destroy');

        Route::get('/mis-proyectos-inscritos', [HostProjectController::class, 'registeredHosts'])->name('my-projects.registeredHosts');

        Route::put('/mis-proyectos-inscritos/{host}/aceptar', [HostProjectController::class, 'acceptHost'])->name('my-projects.acceptHost');
        Route::put('/mis-proyectos-inscritos/{host}/rechazar', [HostProjectController::class, 'rejectHost'])->name('my-projects.rejectHost');
});

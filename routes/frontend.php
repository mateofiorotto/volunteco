<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

Route::middleware('checkEnabled')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');

    Route::get('/proyectos', [FrontendController::class, 'projects'])->name('projects');
    Route::get('/proyectos/{id}', [FrontendController::class, 'projectById'])->name('project');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;


Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/proyectos', [FrontendController::class, 'projects'])->name('projects');
Route::get('/proyectos/{id}', [FrontendController::class, 'projectById'])->name('project');

Route::get('/nosotros', [FrontendController::class, 'about'])->name('about');
Route::get('/contacto', [FrontendController::class, 'contact'])->name('contact');

Route::get('/landing', function () { return view('frontend.landing');})->name('landing');

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\RegisterHostController;
use App\Http\Controllers\Auth\RegisterVolunteerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//AUTH
//vistas de forms de registro
Route::get('register-host', [RegisterHostController::class, 'create'])->name('register-host.create');
Route::get('register-volunteer', [RegisterVolunteerController::class, 'create'])->name('register-volunteer.create');

//llamar a los metodos de creacion de usuario
Route::post('register-host', [RegisterHostController::class, 'store'])->name('register-host.store');
Route::post('register-volunteer', [RegisterVolunteerController::class, 'store'])->name('register-volunteer.store');

//vista login y metodo
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

//auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

require __DIR__ . '/auth.php';

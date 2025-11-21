<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;

Route::get('/landing', [LandingController::class, 'landing'])->name('landing');

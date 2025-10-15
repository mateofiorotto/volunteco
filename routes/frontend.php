<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;

Route::middleware('checkEnabled')->group(function () {
    Route::get('/', [FrontendController::class, 'home'])->name('home');
});

?>
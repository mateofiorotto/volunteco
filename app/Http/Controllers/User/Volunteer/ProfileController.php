<?php

namespace App\Http\Controllers\User\Volunteer;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // ///perfil
    // Route::get('/perfil/{id}', [ProfileController::class, 'getProfile])->name('volunteer-profile');

    // //editar perfil propio
    // Route::get('/mi-perfil/editar', [ProfileController::class, 'editMyProfile'])->name('volunteer-edit-my-profile');
    // Route::put('/mi-perfil/editar', [ProfileController::class, 'updateMyProfile'])->name('volunteer-update-my-profile');

    /**
     * Devolver vista de perfil publico de voluntario
     */
    public function getProfile($id)
    {
          $volunteer = Volunteer::with('user')->findOrFail($id);

        return view('user.volunteer.profile.show', compact('volunteer'));
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditRejectedProfileController extends Controller
{
    /**
     * vista de form de edicion
     */
    public function edit($token, $email)
    {
        Auth::logout();

        $tokenData = DB::table('profile_change_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$tokenData || $tokenData->created_at < now()->subHours(48)) {
            abort(403, 'El enlace ha expirado o es inválido.');
        }

        $host = User::with('host')->where('email', $email)->firstOrFail();

        return view('auth.edit-rejected-profile', ['host' => $host, 'token' => $token, 'email' => $email]);
    }

    /**
     * metodo de actualizacion
     */
    public function update(Request $request, $token, $email)
    {

        //validando solo campos de host, los de user no se pueden cambiar
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:5',
            'person_full_name' => 'required|string|max:255|min:10',
            'cuit' => ['required', 'string', 'size:11', 'regex:/^\d+$/'],
            'phone' => ['required', 'string', 'min:6', 'max:15', 'regex:/^\d+$/'],
            'linkedin' => 'nullable|string|max:255|min:10',
            'facebook' => 'nullable|string|max:255|min:10',
            'instagram' => 'nullable|string|max:255|min:10',
            'avatar' => 'nullable|image|max:2048',
            'description' => 'required|string|max:500|min:10',
            'location' => 'nullable|string|max:255|min:5',
        ]);

        //actualizar host
        $host = User::where('email', $email)->first()->host;
        $host->update($validated);

        //status a pendiente
        $user = $host->user;
        $user->status = 'Pendiente';
        $user->save();

        //borrar token
        DB::table('profile_change_tokens')->where('email', $email)->delete();

        return redirect()->route('home')->with('success', 'Tu perfil fue actualizado y está pendiente de revisión.');
    }
}

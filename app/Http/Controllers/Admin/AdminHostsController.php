<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\HostEditRejectedProfileMail;
use App\Mail\ProfileAcceptedMail;
use Illuminate\Support\Facades\Mail;

class AdminHostsController extends Controller
{
    /**
     * Retornar la lista de verificacion de anfitriones
     */
    public function verifyHostsList()
    {
        $hostsDisabled = User::where('user_type', 'Anfitrión')
            ->where('status', 'Inactivo')
            ->with('host')
            ->get();

        $hostsNotVerified = User::where('user_type', 'Anfitrión')
            ->where('status', 'Pendiente')
            ->with('host')
            ->get();

        $hostsVerified = User::where('user_type', 'Anfitrión')
            ->where('status', 'Activo')
            ->with('host')
            ->get();

        return view('admin/hosts-verification/list-verify-hosts', ['hostsNotVerified' => $hostsNotVerified, 'hostsVerified' => $hostsVerified, 'hostsDisabled' => $hostsDisabled]);
    }

    /**
     * Verificar un perfil especifico de anfitrion
     */
    public function verifyHostProfileById($id)
    {
        $host = User::where('id', $id)->with('host')->first();

        return view('admin/hosts-verification/verify-host-profile', ['host' => $host]);
    }

    /**
     * Reactivar un perfil de anfitrion
     */
    public function enableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Activo";
        $host->host->notified = false;
        $host->host->notified_at = null;
        $host->host->save();

        $host->update();

        Mail::to($host->email)->send(new ProfileAcceptedMail($host->host->person_full_name));

        return redirect()->route('lista-verificacion-anfitriones');
    }

    /*
     * Desactivar un perfil de anfitrion
     */
    public function disableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Inactivo";
        $host->host->notified = false;
        $host->host->notified_at = null;
        $host->host->save();

        $host->update();

        return redirect()->route('lista-verificacion-anfitriones');
    }

    /**
     * Enviar mail a un anfitrion rechazado para que pueda cambiar los datos solicitados
     */
    public function sendMailRejectedProfile(Request $request, $hostId)
    {
        $host = User::with('host')->findOrFail($hostId);

        $fieldsToChange = $request->validate([
            'description' => 'required|string|max:500|min:10',
        ]);

        //generar token para que pueda cambiar sus datos de forma segura
        $token = Str::random(64);

        // Guardar en tabla profile_change_tokens (reemplaza si ya existe)
        DB::table('profile_change_tokens')->updateOrInsert(
            ['email' => $host->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        // Crear link
        $link = url("/perfil/editar-datos/$token/" . urlencode($host->email));

        // Enviar mail
        Mail::to($host->email)->send(new HostEditRejectedProfileMail($link, $fieldsToChange['description'], $host->host->person_full_name));

        $host->host->notified = true;
        $host->host->notified_at = now();
        $host->host->save();

        return redirect()->route('lista-verificacion-anfitriones');
    }

    /**
     * Eliminar un perfil de anfitrion
     */
    public function deleteHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->delete();

        return redirect()->route('lista-verificacion-anfitriones');
    }

    /**
     * Poner en pendiente un perfil de anfitrion
     */
    public function setHostProfilePending($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Pendiente";
        $host->host->notified = false;
        $host->host->notified_at = null;

        $host->host->save();

        $host->update();

        return redirect()->route('lista-verificacion-anfitriones');
    }
}

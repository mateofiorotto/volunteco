<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\HostEditRejectedProfileMail;
use App\Mail\HostDeleteProfileMail;
use App\Mail\ProfileAcceptedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\HostRejectedReminder;

class AdminHostsController extends Controller
{
    /**
     * Retornar la lista de verificacion de anfitriones
     */
    public function verifyHostsList()
    {
        // Consulta el rol host
        $hostRole = Role::where('type', 'host')->first();
        if (!$hostRole) {
            abort(500, 'No se encontró el rol "host".');
        }
        $roleId = $hostRole->id;

        $hostsDisabled = User::where('role_id', $roleId)
            ->where('status', 'Inactivo')
            ->with('host')
            ->get();

        $hostsNotVerified = User::where('role_id', $roleId)
            ->where('status', 'Pendiente')
            ->with('host')
            ->get();

        $hostsVerified = User::where('role_id', $roleId)
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
     * Aceptar un perfil de anfitrion
     */
    public function enableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Activo";
        $host->save();

        $host->host->disabled_at = null;
        $host->host->rejection_reason = null;
        $host->host->save();

        Mail::to($host->email)->send(new ProfileAcceptedMail($host->host->person_full_name));

        return redirect()->route('list-verify-hosts');
    }

    /**
     * Reactivar un perfil de anfitrion (no avisa por mail)
     */
    public function reenableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Activo";
        $host->save();

        $host->host->disabled_at = null;
        $host->host->rejection_reason = null;
        $host->host->save();

        return redirect()->route('list-verify-hosts');
    }

    /*
     * Desactivar un perfil de anfitrion
     */
    public function disableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Inactivo";
        $host->save();

        $host->host->disabled_at = now();
        $host->host->rejection_reason = null;
        $host->host->save();

        return redirect()->route('list-verify-hosts');
    }

    /**
     * Enviar mail a un anfitrion rechazado para que pueda cambiar los datos solicitados
     */
    public function sendMailDisabledProfile(Request $request, $id)
    {
        $host = User::with('host')->findOrFail($id);

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

        $host->status = "Inactivo";
        $host->save();

        $host->host->disabled_at = now();
        $host->host->rejection_reason = $fieldsToChange['description'];
        $host->host->save();

        return redirect()->route('list-verify-hosts');
    }

    /**
     * Eliminar un perfil de anfitrion y enviar mail notificando la eliminacion
     */
    public function deleteHostProfile(Request $request, $id)
    {
        $host = User::where('id', $id)->first();

        $reasons = $request->validate([
            'delete_reasons' => 'required|string|max:500|min:10',
        ]);

        $host->delete();

        Mail::to($host->email)->send(new HostDeleteProfileMail($reasons['delete_reasons'], $host->host->person_full_name));

        return redirect()->route('list-verify-hosts');
    }

    /**
     * Poner en pendiente un perfil de anfitrion
     */
    public function setHostProfilePending($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "Pendiente";
        $host->save();

        $host->host->disabled_at = null;
        $host->host->rejection_reason = null;
        $host->host->save();

        return redirect()->route('list-verify-hosts');
    }

    /**
     * Recordatorio de perfil rechazado/deshabilitado
     */
    public function sendHostRejectedReminder($id)
    {
        $host = User::with('host')->findOrFail($id);

        Mail::to($host->email)->send(new HostRejectedReminder($host->host->rejection_reason, $host->host->person_full_name, $host->host->disabled_at));

        return redirect()->route('list-verify-hosts');
    }
}

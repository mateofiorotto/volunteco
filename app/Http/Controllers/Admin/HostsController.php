<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\HostEditRejectedProfileMail;
use App\Mail\HostDeleteProfileMail;
use App\Mail\HostAcceptedMail;
use App\Mail\HostRejectedReminder;
use App\Models\User;
use App\Models\Host;
use Illuminate\Support\Facades\Storage;

class HostsController extends Controller
{

    /**
     * Retornar la lista de anfitriones por estado
     */
    public function index()
    {
        //asignar a cada variable llamando al metodo getHostsByStatus
        $hostsDisabled = $this->getHostsByStatus('inactivo');
        $hostsNotVerified = $this->getHostsByStatus('pendiente');
        $hostsVerified = $this->getHostsByStatus('activo');

        return view('admin.hosts.index', compact(
            'hostsDisabled',
            'hostsNotVerified',
            'hostsVerified'
        ));
    }

    /**
     * Obtener anfitriones por su estado
     */
    public function getHostsByStatus(string $status)
    {
        //se manda el nombre del parametro para la paginacion, por ejemplo (?disabled=1 en vez de page, si no, se pisan los valores)
        $pageName = match ($status) {
            'inactivo' => 'disabled',
            'pendiente' => 'not_verified',
            'activo' => 'verified',
            default => 'page'
        };

         return Host::whereHas('user', function ($query) use ($status) {
            $query->where('status', $status);
            })
            ->with('user')
            ->withCount('projects')
            ->orderBy('created_at', 'desc')
            ->paginate(6, ['*'], $pageName);
    }

    /**
     * Obtener un perfil de anfitrion por id
     */
    public function profile($id)
    {
        $host = Host::where('id', $id)->with('projects.volunteers', 'location.province')->firstOrFail();

        return view('admin.hosts.profile', ['host' => $host]);
    }

    /**
     * Aceptar un perfil de anfitrion
     */
    public function enableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "activo";
        $host->save();

        $host->host->disabled_at = null;
        $host->host->rejection_reason = null;
        $host->host->save();

        Mail::to($host->email)->send(new HostAcceptedMail($host->host->person_full_name));

        return redirect()->route('admin.hosts.index')->with('success', 'Perfil de anfitrión activado correctamente y notificación enviada por email.');
    }

    /**
     * Reactivar un perfil de anfitrion (no avisa por mail)
     */
    public function reenableHostProfile($id)
    {
        $user = User::where('id', $id)->first();

        $user->status = "activo";
        $user->save();

        $user->host->disabled_at = null;
        $user->host->rejection_reason = null;
        $user->host->save();

        return redirect()->route('admin.hosts.index')->with('success', 'Perfil de anfitrión reactivado correctamente.');
    }

    /*
     * Desactivar un perfil de anfitrion
     */
    public function disableHostProfile($id)
    {
        $user = User::where('id', $id)->first();

        // Primero deshabilito los proyectos del host
        $user->host->projects()->update([
            'enabled' => 0,
        ]);

        $user->status = "inactivo";
        $user->save();

        $user->host->disabled_at = now();
        $user->host->save();

        return redirect()->route('admin.hosts.index')->with('success', 'Perfil de anfitrión desactivado correctamente.');
    }

    /**
     * Enviar mail a un anfitrion rechazado para que pueda cambiar los datos solicitados
     */
    public function sendMailDisabledProfile(Request $request, $id)
    {
        $user = User::with('host')->findOrFail($id);

        $fieldsToChange = $request->validate([
            'description' => 'required|string|max:500|min:10',
        ]);

        //generar token para que pueda cambiar sus datos de forma segura
        $token = Str::random(64);

        // Guardar en tabla profile_change_tokens (reemplaza si ya existe)
        DB::table('profile_change_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        // Crear link
        $link = route('edit-rejected-profile', ['token' => $token, 'email' => $user->email]);

        // Enviar mail
        Mail::to($user->email)->send(new HostEditRejectedProfileMail($link, $fieldsToChange['description'], $user->host->person_full_name));

        // Primero deshabilito los proyectos del host
        $user->host->projects()->update([
            'enabled' => 0,
        ]);

        $user->status = "inactivo";
        $user->save();

        $user->host->disabled_at = now();
        $user->host->rejection_reason = $fieldsToChange['description'];
        $user->host->save();

        return redirect()->route('admin.hosts.index')->with('success', 'Email enviado y perfil desactivado correctamente.');
    }

    /**
     * Eliminar un perfil de anfitrion y enviar mail notificando la eliminacion
     */
    public function deleteHostProfile(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $reasons = $request->validate([
            'delete_reasons' => 'required|string|max:500|min:10',
        ]);

        // Chequeo que tenga anfitrion y si lo tiene checkea que tenga avatar sino es null
        if ($user->host?->avatar) {
            Storage::disk('public')->delete($user->host->avatar);
            // Usuario softDeletes
            $user->host->avatar = null;
            $user->host->save();
        }

        //mandar mail
        Mail::to($user->email)->send(new HostDeleteProfileMail($reasons['delete_reasons'], $user->host->person_full_name));

        // Elimino tambien el perfil del host
        $user->host?->delete();

        $user->delete();

        return redirect()->route('admin.hosts.index')->with('success', "Perfil eliminado correctamente y notificación enviada por email.");
    }

    /**
     * Poner en pendiente un perfil de anfitrion
     */
    public function setHostProfilePending($id)
    {
        $user = User::where('id', $id)->first();

        $user->status = "pendiente";
        $user->save();

        $user->host->save();

        return redirect()->route('admin.hosts.index')->with('success', 'Perfil de anfitrión enviado a pendiente correctamente.');
    }

    /**
     * Recordatorio de perfil rechazado/deshabilitado
     */
    public function sendHostRejectedReminder($id)
    {
        $user = User::with('host')->findOrFail($id);

        Mail::to($user->email)->send(new HostRejectedReminder($user->host->rejection_reason, $user->host->person_full_name, $user->host->disabled_at));

        return redirect()->route('admin.hosts.index')->with('success', 'Recordatorio enviado correctamente por email.');
    }
}

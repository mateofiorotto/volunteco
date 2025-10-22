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
use App\Services\ImageService;

class AdminHostsController extends Controller
{
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function getHostsByStatus(string $roleType, string $status)
    {
        return User::whereHas('role', function ($query) use ($roleType) {
                    $query->where('type', $roleType);
                })
                ->where('status', $status)
                ->with(['host'])
                ->get();
    }

    /**
     * Retornar la lista de anfitriones por estado
     */
    public function statusHostsList()
    {
        if (!Role::where('type', 'host')->exists()) {
            abort(500, 'El tipo de rol "host" no existe.');
        }

        $hostsDisabled = $this->getHostsByStatus('host', 'inactivo');
        $hostsNotVerified = $this->getHostsByStatus('host', 'pendiente');
        $hostsVerified = $this->getHostsByStatus('host', 'activo');

        return view('admin.hosts.host-list-status', compact(
            'hostsDisabled', 'hostsNotVerified', 'hostsVerified'
        ));
    }

    /**
     * Obtener un perfil de anfitrion por id
     */
    public function getHostProfileById($id)
    {
        $host = User::where('id', $id)->with('host')->first();

        return view('admin/hosts/host-profile', ['host' => $host]);
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

        Mail::to($host->email)->send(new ProfileAcceptedMail($host->host->person_full_name));

        return redirect()->route('hosts-list');
    }

    /**
     * Reactivar un perfil de anfitrion (no avisa por mail)
     */
    public function reenableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "activo";
        $host->save();

        $host->host->disabled_at = null;
        $host->host->rejection_reason = null;
        $host->host->save();

        return redirect()->route('hosts-list');
    }

    /*
     * Desactivar un perfil de anfitrion
     */
    public function disableHostProfile($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "inactivo";
        $host->save();

        $host->host->disabled_at = now();
        //$host->host->rejection_reason = null;
        $host->host->save();

        return redirect()->route('hosts-list');
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

        $host->status = "inactivo";
        $host->save();

        $host->host->disabled_at = now();
        $host->host->rejection_reason = $fieldsToChange['description'];
        $host->host->save();

        return redirect()->route('hosts-list');
    }

    public function sendMailUncompleteProfile(Request $request, $id)
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

        $host->status = "pendiente";
        $host->save();

        $host->host->disabled_at = now();
        $host->host->rejection_reason = $fieldsToChange['description'];
        $host->host->save();

        return redirect()->route('hosts-list');
    }

    /**
     * Eliminar un perfil de anfitrion y enviar mail notificando la eliminacion
     */
    public function deleteHostProfile(Request $request, $id)
    {
        $host = User::where('id', $id)->first();

        if (!$host || !$host->host) {
            return back()->withErrors(['error' => 'No se encontró el anfitrión']);
        }

        $reasons = $request->validate([
            'delete_reasons' => 'required|string|max:500|min:10',
        ]);

        if ($host->host->avatar) {
            $this->imageService->deleteImage($host->host->avatar);
        }

        $host->delete();

        Mail::to($host->email)->send(new HostDeleteProfileMail($reasons['delete_reasons'], $host->host->person_full_name));

        return redirect()->route('hosts-list');
    }

    /**
     * Poner en pendiente un perfil de anfitrion
     */
    public function setHostProfilePending($id)
    {
        $host = User::where('id', $id)->first();

        $host->status = "pendiente";
        $host->save();

        // $host->host->disabled_at = null;
        // $host->host->rejection_reason = null;
        $host->host->save();

        return redirect()->route('hosts-list');
    }

    /**
     * Recordatorio de perfil rechazado/deshabilitado
     */
    public function sendHostRejectedReminder($id)
    {
        $host = User::with('host')->findOrFail($id);

        Mail::to($host->email)->send(new HostRejectedReminder($host->host->rejection_reason, $host->host->person_full_name, $host->host->disabled_at));

        return redirect()->route('hosts-list');
    }
}

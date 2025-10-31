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

class HostsController extends Controller
{
    protected $imageService;

    //inyectar el servicio de imgs
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Retornar la lista de anfitriones por estado
     */
    public function index()
    {
        $hostsDisabled = $this->getHostsByStatus('inactivo');
        $hostsNotVerified = $this->getHostsByStatus('pendiente');
        $hostsVerified = $this->getHostsByStatus('activo');

        return view('admin.hosts.index', compact(
            'hostsDisabled', 'hostsNotVerified', 'hostsVerified'
        ));
    }

    /**
     * Obtener anfitriones por status
     */
    public function getHostsByStatus(string $status)
    {
        return User::whereHas('role', function ($query) {
                    $query->where('type', 'host');
                })
                ->where('status', $status)
                ->with(['host'])
                ->get();
    }

    /**
     * Obtener un perfil de anfitrion por id
     */
    public function getHostProfileById($id)
    {
        //$host = User::where('id', $id)->with('host')->first();
        $host = User::where('id', $id)->with('host.projects')->firstOrFail();

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

        Mail::to($host->email)->send(new ProfileAcceptedMail($host->host->person_full_name));

        return redirect()->route('admin.hosts.index');
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

        return redirect()->route('admin.hosts.index');
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

        return redirect()->route('admin.hosts.index');
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

        return redirect()->route('admin.hosts.index');
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

        return redirect()->route('admin.hosts.index');
    }

    /**
     * Eliminar un perfil de anfitrion y enviar mail notificando la eliminacion
     */
    public function deleteHostProfile(Request $request, $id)
    {
        $host = User::where('id', $id)->firstOrFail();

        $reasons = $request->validate([
            'delete_reasons' => 'required|string|max:500|min:10',
        ]);

        if ($host->host->avatar && $host->host->avatar !== 'logo.svg') {
            $this->imageService->deleteImage($host->host->avatar);
        }

        $host->delete();

        Mail::to($host->email)->send(new HostDeleteProfileMail($reasons['delete_reasons'], $host->host->person_full_name));

        return redirect()->route('admin.hosts.index');
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

        return redirect()->route('admin.hosts.index');
    }

    /**
     * Recordatorio de perfil rechazado/deshabilitado
     */
    public function sendHostRejectedReminder($id)
    {
        $host = User::with('host')->findOrFail($id);

        Mail::to($host->email)->send(new HostRejectedReminder($host->host->rejection_reason, $host->host->person_full_name, $host->host->disabled_at));

        return redirect()->route('admin.hosts.index');
    }
}

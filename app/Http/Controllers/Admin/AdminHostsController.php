<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminHostsController extends Controller
{
    /**
     * Retornar la lista de verificacion de anfitriones
     */
    public function verifyHostsList(){
        $hostsNotVerified = User::where('user_type', 'Anfitrión')
        ->where('enabled', false)
        ->with('host')
        ->get();

        $hostsVerified = User::where('user_type', 'Anfitrión')
        ->where('enabled', true)
        ->with('host')
        ->get();

        return view('admin/hosts-verification/list-verify-hosts', ['hostsNotVerified' => $hostsNotVerified, 'hostsVerified' => $hostsVerified]);
    }

    /**
     * Verificar un perfil especifico de anfitrion
     */
    public function verifyHostProfileById($id){
        $host = User::where('id', $id)->with('host')->first();
        return view('admin/hosts-verification/verify-host-profile', ['host' => $host]);
    }

    /**
     * Aceptar un perfil de anfitrion
     */
    public function acceptHostProfile($id){
        $host = User::where('id', $id)->first();

        $host->enabled = true;

        $host->update();

        return redirect()->route('lista-verificacion-anfitriones');
    }
     
    /**
     * Rechazar un perfil de anfitrion
     */
    public function rejectHostProfile($id){
        $host = User::where('id', $id)->first();

        $host->delete();

        return redirect()->route('lista-verificacion-anfitriones');
    }

    /*
     * Desactivar un perfil de anfitrion
     */
    public function disableHostProfile($id){
        $host = User::where('id', $id)->first();

        $host->enabled = false;

        $host->update();

        return redirect()->route('lista-verificacion-anfitriones');
    }
}

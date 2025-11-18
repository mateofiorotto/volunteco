<?php

namespace App\Policies;

use App\Models\Host;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Host $host): bool
    {
        // Obtener el voluntario relacionado al usuario
        $volunteer = $user->volunteer;

        if (!$volunteer) {
            return false; // si no es voluntario, no puede ver nada
        }

        // Verificar que el voluntario esté en un proyecto del host con status "aceptado"
        // El voluntario solo podrá ver un anfitrión que lo haya aceptado en algun proyecto
        return $volunteer->projects()
            ->where('host_id', $host->id)
            ->wherePivot('status', 'aceptado')
            ->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Host $host): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Host $host): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Host $host): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Host $host): bool
    {
        return false;
    }
}

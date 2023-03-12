<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function viewAny(User $user)
    {
        return $user->tipo_usuario_id == 3;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */
    public function view(User $user, Medico $medico)
    {
        return $user->tipo_usuario_id == 3;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function create(User $user)
    {
        return $user->tipo_usuario_id == 3;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */
    public function update(User $user, Medico $medico)
    {
        return $user->tipo_usuario_id == 3 || $medico->id == $user->medico_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala $sala
     * @return mixed
     */
    public function delete(User $user, Medico $medico)
    {
        return $user->tipo_usuario_id == 3;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */
    /*
    public function restore(User $user, Sala $sala)
    {
        //
    }
    */
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */

    /*
    public function forceDelete(User $user, Sala $sala)
    {
        //
    }
    */
}

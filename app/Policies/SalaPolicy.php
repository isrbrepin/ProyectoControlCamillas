<?php

namespace App\Policies;

use App\Models\Sala;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */
    public function view(User $user, Sala $sala)
    {
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 2 && $sala->paciente_id == $user->paciente->id) || ($user->tipo_usuario_id == 1 && $sala->medico_id == $user->medico->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */

    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */
    public function update(User $user, Sala $sala)
    {
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 2 && $sala->paciente_id == $user->paciente->id) || ($user->tipo_usuario_id == 1 && $sala->medico_id == $user->medico->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sala  $sala
     * @return mixed
     */
    public function delete(User $user, Sala $sala)
    {
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 2 && $sala->paciente_id == $user->paciente->id) || ($user->tipo_usuario_id == 1 && $sala->medico_id == $user->medico->id);
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

    public function attach_medicamento(User $user, Sala $sala)
    {
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 1 && $sala->medico_id == $user->medico->id);
    }

    public function detach_medicamento(User $user, Sala $sala)
    {
        return $user->tipo_usuario_id == 3 || ($user->tipo_usuario_id == 1 && $sala->medico_id == $user->medico->id);
    }
}

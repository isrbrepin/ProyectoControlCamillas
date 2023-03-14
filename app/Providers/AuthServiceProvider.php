<?php

namespace App\Providers;

use App\Models\Sala;
use App\Models\Especialidad;
use App\Models\Medicamento;
use App\Models\Medico;
use App\Models\Paciente;
use App\Policies\SalaPolicy;
use App\Policies\EspecialidadPolicy;
use App\Policies\MedicamentoPolicy;
use App\Policies\MedicoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Sala::class => SalaPolicy::class,
        Especialidad::class => EspecialidadPolicy::class,
        Medico::class => MedicoPolicy::class,
        Medicamento::class => MedicamentoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

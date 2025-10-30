<?php

namespace App\Providers;

use App\Models\Employe;
use App\Models\Conge;
use App\Models\Absence;
use App\Models\Formation;
use App\Models\Evenement;
use App\Policies\EmployePolicy;
use App\Policies\CongePolicy;
use App\Policies\AbsencePolicy;
use App\Policies\FormationPolicy;
use App\Policies\EvenementPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Employe::class => EmployePolicy::class,
        Conge::class => CongePolicy::class,
        Absence::class => AbsencePolicy::class,
        Formation::class => FormationPolicy::class,
        Evenement::class => EvenementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}


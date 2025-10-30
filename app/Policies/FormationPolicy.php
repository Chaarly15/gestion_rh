<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Formation;

class FormationPolicy
{
    /**
     * Determine if the user can view any formations.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('formations.view');
    }

    /**
     * Determine if the user can view the formation.
     */
    public function view(User $user, Formation $formation): bool
    {
        return $user->hasPermissionTo('formations.view');
    }

    /**
     * Determine if the user can create formations.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('formations.create');
    }

    /**
     * Determine if the user can update the formation.
     */
    public function update(User $user, Formation $formation): bool
    {
        return $user->hasPermissionTo('formations.update');
    }

    /**
     * Determine if the user can delete the formation.
     */
    public function delete(User $user, Formation $formation): bool
    {
        return $user->hasPermissionTo('formations.delete');
    }

    /**
     * Determine if the user can enroll in the formation.
     */
    public function enroll(User $user, Formation $formation): bool
    {
        return $user->hasPermissionTo('formations.enroll');
    }

    /**
     * Determine if the user can enroll others in the formation.
     */
    public function enrollOthers(User $user, Formation $formation): bool
    {
        return $user->hasPermissionTo('formations.enroll-others');
    }

    /**
     * Determine if the user can evaluate the formation.
     */
    public function evaluate(User $user, Formation $formation): bool
    {
        return $user->hasPermissionTo('formations.evaluate');
    }

    /**
     * Determine if the user can export formations.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo('formations.export');
    }
}


<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employe;

class EmployePolicy
{
    /**
     * Determine if the user can view any employees.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('employes.view') || 
               $user->hasPermissionTo('employes.view-own');
    }

    /**
     * Determine if the user can view the employee.
     */
    public function view(User $user, Employe $employe): bool
    {
        // Admin et RH peuvent voir tous les employés
        if ($user->hasPermissionTo('employes.view')) {
            return true;
        }

        // Manager peut voir les employés de sa direction
        if ($user->hasPermissionTo('employes.view-own') && $user->employe) {
            if ($user->isManager()) {
                return $employe->id_direction === $user->employe->id_direction;
            }
            
            // Employé peut voir uniquement ses propres données
            return $employe->id_employe === $user->employe->id_employe;
        }

        return false;
    }

    /**
     * Determine if the user can create employees.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('employes.create');
    }

    /**
     * Determine if the user can update the employee.
     */
    public function update(User $user, Employe $employe): bool
    {
        // Admin et RH peuvent modifier tous les employés
        if ($user->hasPermissionTo('employes.update')) {
            return true;
        }

        // Employé peut modifier uniquement ses propres données (limitées)
        if ($user->hasPermissionTo('employes.update-own') && $user->employe) {
            return $employe->id_employe === $user->employe->id_employe;
        }

        return false;
    }

    /**
     * Determine if the user can delete the employee.
     */
    public function delete(User $user, Employe $employe): bool
    {
        return $user->hasPermissionTo('employes.delete');
    }

    /**
     * Determine if the user can export employees.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo('employes.export');
    }

    /**
     * Determine if the user can manage documents for the employee.
     */
    public function manageDocuments(User $user, Employe $employe): bool
    {
        // Admin et RH peuvent gérer tous les documents
        if ($user->hasPermissionTo('documents.manage')) {
            return true;
        }

        // Employé peut gérer ses propres documents
        if ($user->hasPermissionTo('documents.upload') && $user->employe) {
            return $employe->id_employe === $user->employe->id_employe;
        }

        return false;
    }
}


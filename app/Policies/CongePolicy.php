<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Conge;

class CongePolicy
{
    /**
     * Determine if the user can view any congés.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('conges.view') || 
               $user->hasPermissionTo('conges.view-own');
    }

    /**
     * Determine if the user can view the congé.
     */
    public function view(User $user, Conge $conge): bool
    {
        // Admin et RH peuvent voir tous les congés
        if ($user->hasPermissionTo('conges.view')) {
            return true;
        }

        // Manager peut voir les congés de sa direction
        if ($user->hasPermissionTo('conges.view-own') && $user->employe) {
            if ($user->isManager()) {
                return $conge->employe->id_direction === $user->employe->id_direction;
            }
            
            // Employé peut voir uniquement ses propres congés
            return $conge->id_employe === $user->employe->id_employe;
        }

        return false;
    }

    /**
     * Determine if the user can create congés.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('conges.create');
    }

    /**
     * Determine if the user can update the congé.
     */
    public function update(User $user, Conge $conge): bool
    {
        // Admin et RH peuvent modifier tous les congés
        if ($user->hasPermissionTo('conges.update')) {
            return true;
        }

        // Employé peut modifier uniquement ses propres congés (si en attente)
        if ($user->hasPermissionTo('conges.update-own') && $user->employe) {
            return $conge->id_employe === $user->employe->id_employe && 
                   $conge->statut === 'En attente';
        }

        return false;
    }

    /**
     * Determine if the user can delete the congé.
     */
    public function delete(User $user, Conge $conge): bool
    {
        // Admin et RH peuvent supprimer tous les congés
        if ($user->hasPermissionTo('conges.delete')) {
            return true;
        }

        // Employé peut supprimer ses propres congés (si en attente)
        if ($user->employe) {
            return $conge->id_employe === $user->employe->id_employe && 
                   $conge->statut === 'En attente';
        }

        return false;
    }

    /**
     * Determine if the user can validate the congé.
     */
    public function validate(User $user, Conge $conge): bool
    {
        // Admin et RH peuvent valider tous les congés
        if ($user->hasPermissionTo('conges.validate')) {
            // Ne peut pas valider son propre congé
            if ($user->employe && $conge->id_employe === $user->employe->id_employe) {
                return false;
            }
            
            // Manager peut valider les congés de sa direction
            if ($user->isManager() && $user->employe) {
                return $conge->employe->id_direction === $user->employe->id_direction;
            }
            
            // RH et Admin peuvent valider tous les congés
            return $user->isRH() || $user->isAdmin();
        }

        return false;
    }

    /**
     * Determine if the user can reject the congé.
     */
    public function reject(User $user, Conge $conge): bool
    {
        // Même logique que validate
        return $this->validate($user, $conge);
    }

    /**
     * Determine if the user can export congés.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo('conges.export');
    }
}


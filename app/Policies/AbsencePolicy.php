<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Absence;

class AbsencePolicy
{
    /**
     * Determine if the user can view any absences.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('absences.view') || 
               $user->hasPermissionTo('absences.view-own');
    }

    /**
     * Determine if the user can view the absence.
     */
    public function view(User $user, Absence $absence): bool
    {
        // Admin et RH peuvent voir toutes les absences
        if ($user->hasPermissionTo('absences.view')) {
            return true;
        }

        // Manager peut voir les absences de sa direction
        if ($user->hasPermissionTo('absences.view-own') && $user->employe) {
            if ($user->isManager()) {
                return $absence->employe->id_direction === $user->employe->id_direction;
            }
            
            // Employé peut voir uniquement ses propres absences
            return $absence->id_employe === $user->employe->id_employe;
        }

        return false;
    }

    /**
     * Determine if the user can create absences.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('absences.create');
    }

    /**
     * Determine if the user can update the absence.
     */
    public function update(User $user, Absence $absence): bool
    {
        // Admin et RH peuvent modifier toutes les absences
        if ($user->hasPermissionTo('absences.update')) {
            return true;
        }

        // Employé peut modifier uniquement ses propres absences (si non validée)
        if ($user->hasPermissionTo('absences.update-own') && $user->employe) {
            return $absence->id_employe === $user->employe->id_employe && 
                   $absence->statut !== 'Validée';
        }

        return false;
    }

    /**
     * Determine if the user can delete the absence.
     */
    public function delete(User $user, Absence $absence): bool
    {
        // Admin et RH peuvent supprimer toutes les absences
        if ($user->hasPermissionTo('absences.delete')) {
            return true;
        }

        // Employé peut supprimer ses propres absences (si non validée)
        if ($user->employe) {
            return $absence->id_employe === $user->employe->id_employe && 
                   $absence->statut !== 'Validée';
        }

        return false;
    }

    /**
     * Determine if the user can validate the absence.
     */
    public function validate(User $user, Absence $absence): bool
    {
        // Admin et RH peuvent valider toutes les absences
        if ($user->hasPermissionTo('absences.validate')) {
            // Ne peut pas valider sa propre absence
            if ($user->employe && $absence->id_employe === $user->employe->id_employe) {
                return false;
            }
            
            // Manager peut valider les absences de sa direction
            if ($user->isManager() && $user->employe) {
                return $absence->employe->id_direction === $user->employe->id_direction;
            }
            
            // RH et Admin peuvent valider toutes les absences
            return $user->isRH() || $user->isAdmin();
        }

        return false;
    }

    /**
     * Determine if the user can export absences.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo('absences.export');
    }

    /**
     * Determine if the user can manage justificatifs for the absence.
     */
    public function manageJustificatifs(User $user, Absence $absence): bool
    {
        // Admin et RH peuvent gérer tous les justificatifs
        if ($user->hasPermissionTo('documents.manage')) {
            return true;
        }

        // Employé peut gérer ses propres justificatifs
        if ($user->hasPermissionTo('documents.upload') && $user->employe) {
            return $absence->id_employe === $user->employe->id_employe;
        }

        return false;
    }
}


<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Evenement;

class EvenementPolicy
{
    /**
     * Determine if the user can view any événements.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('evenements.view');
    }

    /**
     * Determine if the user can view the événement.
     */
    public function view(User $user, Evenement $evenement): bool
    {
        return $user->hasPermissionTo('evenements.view');
    }

    /**
     * Determine if the user can create événements.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('evenements.create');
    }

    /**
     * Determine if the user can update the événement.
     */
    public function update(User $user, Evenement $evenement): bool
    {
        // Admin et RH peuvent modifier tous les événements
        if ($user->hasPermissionTo('evenements.update')) {
            return true;
        }

        // L'organisateur peut modifier son propre événement
        if ($user->employe && $evenement->organisateur_id === $user->employe->id_employe) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can delete the événement.
     */
    public function delete(User $user, Evenement $evenement): bool
    {
        // Admin et RH peuvent supprimer tous les événements
        if ($user->hasPermissionTo('evenements.delete')) {
            return true;
        }

        // L'organisateur peut supprimer son propre événement
        if ($user->employe && $evenement->organisateur_id === $user->employe->id_employe) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can participate in the événement.
     */
    public function participate(User $user, Evenement $evenement): bool
    {
        return $user->hasPermissionTo('evenements.participate');
    }

    /**
     * Determine if the user can manage participants for the événement.
     */
    public function manageParticipants(User $user, Evenement $evenement): bool
    {
        // Admin et RH peuvent gérer tous les participants
        if ($user->hasPermissionTo('evenements.manage-participants')) {
            return true;
        }

        // L'organisateur peut gérer les participants de son événement
        if ($user->employe && $evenement->organisateur_id === $user->employe->id_employe) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can export événements.
     */
    public function export(User $user): bool
    {
        return $user->hasPermissionTo('evenements.export');
    }
}


<?php

namespace App\Models\Services;

use App\Models\Conge;
use App\Models\Employe;
use App\Models\SoldeConge;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CongeService extends Model
{
     public function verifierDisponibilite(Employe $employe, Carbon $dateDebut, Carbon $dateFin): bool
    {
        return !Conge::where('id_employe', $employe->id_employe)
            ->where('statut', '!=', 'Rejetée')
            ->where(function($query) use ($dateDebut, $dateFin) {
                $query->whereBetween('date_debut', [$dateDebut, $dateFin])
                      ->orWhereBetween('date_fin', [$dateDebut, $dateFin])
                      ->orWhere(function($q) use ($dateDebut, $dateFin) {
                          $q->where('date_debut', '<=', $dateDebut)
                            ->where('date_fin', '>=', $dateFin);
                      });
            })
            ->exists();
    }

    public function calculerSolde(Employe $employe, int $annee = null): array
    {
        $annee = $annee ?? now()->year;
        $solde = SoldeConge::calculerPourEmploye($employe, $annee);

        return [
            'jours_acquis' => $solde->jours_acquis,
            'jours_pris' => $solde->jours_pris,
            'jours_restants' => $solde->jours_restants,
            'jours_reportes' => $solde->jours_reportes,
        ];
    }

    public function creerDemande(array $data): Conge
    {
        // Vérifier disponibilité
        if (!$this->verifierDisponibilite(
            Employe::find($data['id_employe']),
            Carbon::parse($data['date_debut']),
            Carbon::parse($data['date_fin'])
        )) {
            throw new \Exception('Un congé existe déjà pour cette période');
        }

        // Vérifier le solde
        $employe = Employe::find($data['id_employe']);
        $solde = $this->calculerSolde($employe);
        $nombreJours = Carbon::parse($data['date_debut'])->diffInDays($data['date_fin']) + 1;

        if ($nombreJours > $solde['jours_restants']) {
            throw new \Exception('Solde de congés insuffisant');
        }

        return Conge::create($data);
    }

    public function valider(Conge $conge, $userId = null): void
    {
        $conge->valider($userId);
        
        // Mettre à jour le solde
        SoldeConge::calculerPourEmploye($conge->employe, $conge->date_debut->year);
    }

    public function rejeter(Conge $conge, string $motif, $userId = null): void
    {
        $conge->rejeter($motif, $userId);
    }

    public function statistiquesParDirection(int $annee = null): array
    {
        $annee = $annee ?? now()->year;

        return Conge::with(['employe.direction'])
            ->whereYear('date_debut', $annee)
            ->where('statut', 'Validée')
            ->get()
            ->groupBy('employe.direction.nom')
            ->map(function($conges) {
                return [
                    'nombre' => $conges->count(),
                    'jours_total' => $conges->sum('nombre_jours'),
                ];
            })
            ->toArray();
    }
}

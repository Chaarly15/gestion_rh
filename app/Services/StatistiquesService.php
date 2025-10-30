<?php

namespace App\Models\Services;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Employe;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StatistiquesService extends Model
{
    public function tableauDeBord(): array
    {
        return [
            'effectif' => [
                'total' => Employe::count(),
                'actifs' => Employe::where('statut', 'Actif')->count(),
                'en_conge' => $this->getEmployesEnConge(),
                'nouveaux_mois' => Employe::whereMonth('date_embauche', now()->month)->count(),
            ],
            'conges' => [
                'en_attente' => Conge::enAttente()->count(),
                'en_cours' => Conge::enCours()->count(),
                'a_venir' => Conge::aVenir()->count(),
            ],
            'absences' => [
                'ce_mois' => Absence::ceMois()->count(),
                'en_attente' => Absence::enAttente()->count(),
                'non_justifiees' => Absence::parType('Non justifiée')->ceMois()->count(),
            ],
            'formations' => [
                'planifiees' => Formation::planifiees()->count(),
                'en_cours' => Formation::enCours()->count(),
                'taux_participation' => $this->getTauxParticipationFormations(),
            ],
        ];
    }

    public function statistiquesConges(int $annee = null): array
    {
        $annee = $annee ?? now()->year;

        $conges = Conge::pourAnnee($annee)->get();

        return [
            'total' => $conges->count(),
            'valides' => $conges->where('statut', 'Validée')->count(),
            'rejetes' => $conges->where('statut', 'Rejetée')->count(),
            'en_attente' => $conges->where('statut', 'En attente')->count(),
            'jours_total' => $conges->where('statut', 'Validée')->sum('nombre_jours'),
            'par_type' => $conges->groupBy('typeConge.libelle')->map->count(),
            'par_mois' => $conges->groupBy(fn($c) => $c->date_debut->format('m'))->map->count(),
        ];
    }

    public function tauxAbsenteisme(int $mois = null, int $annee = null): float
    {
        $mois = $mois ?? now()->month;
        $annee = $annee ?? now()->year;

        $totalEmployes = Employe::where('statut', 'Actif')->count();
        $joursOuvrables = 22; // Approximation

        $joursAbsence = Absence::whereMonth('date_debut', $mois)
            ->whereYear('date_debut', $annee)
            ->get()
            ->sum(function($absence) {
                if ($absence->date_fin) {
                    return $absence->date_debut->diffInDays($absence->date_fin) + 1;
                }
                return $absence->duree_heures ? $absence->duree_heures / 8 : 1;
            });

        if ($totalEmployes == 0) {
            return 0;
        }

        return round(($joursAbsence / ($totalEmployes * $joursOuvrables)) * 100, 2);
    }

    private function getEmployesEnConge(): int
    {
        return Conge::enCours()->distinct('id_employe')->count();
    }

    private function getTauxParticipationFormations(): float
    {
        $totalEmployes = Employe::where('statut', 'Actif')->count();
        
        if ($totalEmployes == 0) {
            return 0;
        }
        $employesEnFormation = DB::table('employe_formation')
            ->distinct('id_employe')
            ->count();

        return round(($employesEnFormation / $totalEmployes) * 100, 2);
    }

    public function pyramideDesAges(): array
    {
        return Employe::selectRaw('
            CASE 
                WHEN TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) < 25 THEN "< 25 ans"
                WHEN TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN 25 AND 34 THEN "25-34 ans"
                WHEN TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN 35 AND 44 THEN "35-44 ans"
                WHEN TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN 45 AND 54 THEN "45-54 ans"
                ELSE "55+ ans"
            END as tranche,
            COUNT(*) as total
        ')
        ->groupBy('tranche')
        ->orderByRaw('FIELD(tranche, "< 25 ans", "25-34 ans", "35-44 ans", "45-54 ans", "55+ ans")')
        ->pluck('total', 'tranche')
        ->toArray();
    }
}

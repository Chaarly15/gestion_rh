<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Conge;
use App\Models\Direction;
use App\Models\Employe;
use App\Models\Evenement;
use App\Models\Formation;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();

        // Statistiques générales
        $stats = [
            'total_employes' => Employe::count(),
            'employes_actifs' => Employe::where('statut', 'Actif')->count(),
            'employes_en_conge' => Employe::where('statut', 'En congé')->count(),
            'total_directions' => Direction::count(),
        ];

        // Statistiques des congés
        $congesStats = [
            'en_attente' => Conge::where('statut', 'en_attente')->count(),
            'approuves' => Conge::where('statut', 'approuve')->count(),
            'refuses' => Conge::where('statut', 'rejete')->count(),
            'en_cours' => Conge::where('statut', 'approuve')
                ->where('date_debut', '<=', now())
                ->where('date_fin', '>=', now())
                ->count(),
        ];

        // Statistiques des absences
        $absencesStats = [
            'total_mois' => Absence::whereMonth('date_debut', now()->month)
                ->whereYear('date_debut', now()->year)
                ->count(),
            'justifiees' => Absence::where('statut', 'justifiee')->count(),
            'non_justifiees' => Absence::where('statut', 'non_justifiee')->count(),
        ];

        // Répartition des employés par direction
        $employesParDirection = Direction::withCount('employes')
            ->orderBy('employes_count', 'desc')
            ->limit(5)
            ->get();

        // Répartition par type de contrat
        $employesParContrat = Employe::select('type_contrat', DB::raw('count(*) as total'))
            ->groupBy('type_contrat')
            ->get();

        // Derniers employés ajoutés
        $derniersEmployes = Employe::with(['direction', 'grade', 'profil'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Congés récents en attente (pour Admin/RH)
        $congesEnAttente = [];
        if ($user->isAdmin() || $user->isRH()) {
            $congesEnAttente = Conge::with(['employe', 'typeConge'])
                ->where('statut', 'en_attente')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        }

        // Prochains événements
        $prochainsEvenements = Evenement::with('typeEvenement')
            ->where('date_debut', '>=', now()->toDateString())
            ->orderBy('date_debut', 'asc')
            ->limit(5)
            ->get();

        // Formations en cours
        $formationsEnCours = Formation::where('statut', 'en_cours')
            ->orderBy('date_debut', 'desc')
            ->limit(5)
            ->get();

        // Anniversaires du mois
        $anniversaires = Employe::whereMonth('date_naissance', now()->month)
            ->orderByRaw('DAY(date_naissance)')
            ->limit(5)
            ->get();

        // Graphique: Évolution des employés (6 derniers mois)
        $evolutionEmployes = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $evolutionEmployes[] = [
                'mois' => $date->format('M Y'),
                'total' => Employe::whereDate('date_embauche', '<=', $date->endOfMonth())
                    ->count(),
            ];
        }

        // Graphique: Congés par mois (année en cours)
        $congesParMois = [];
        for ($i = 1; $i <= 12; $i++) {
            $congesParMois[] = [
                'mois' => date('M', mktime(0, 0, 0, $i, 1)),
                'total' => Conge::whereYear('date_debut', now()->year)
                    ->whereMonth('date_debut', $i)
                    ->count(),
            ];
        }

        return view('dashboard', compact(
            'stats',
            'congesStats',
            'absencesStats',
            'employesParDirection',
            'employesParContrat',
            'derniersEmployes',
            'congesEnAttente',
            'prochainsEvenements',
            'formationsEnCours',
            'anniversaires',
            'evolutionEmployes',
            'congesParMois'
        ));
    }
}

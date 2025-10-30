<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoldeConge extends Model
{
    protected $table = 'solde_conges';

    protected $fillable = [
        'id_employe',
        'annee',
        'jours_acquis',
        'jours_pris',
        'jours_reportes',
        'date_calcul',
    ];

    protected $casts = [
        'annee' => 'integer',
        'jours_acquis' => 'decimal:2',
        'jours_pris' => 'decimal:2',
        'jours_reportes' => 'decimal:2',
        'date_calcul' => 'date',
    ];

    // Relations
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }

    // Accesseurs
    public function getJoursRestantsAttribute(): float
    {
        return $this->jours_acquis - $this->jours_pris;
    }

    // Méthodes statiques
    public static function calculerPourEmploye(Employe $employe, int $annee = null)
    {
        $annee = $annee ?? now()->year;
        
        // Calcul des jours acquis (2.5 jours par mois travaillé)
        $dateDebut = $employe->date_embauche->year == $annee 
            ? $employe->date_embauche 
            : now()->setYear($annee)->startOfYear();
            
        $moisTravailles = $dateDebut->diffInMonths(now()->setYear($annee)->endOfYear()) + 1;
        $joursAcquis = min($moisTravailles * 2.5, 30); // Max 30 jours/an

        // Calcul des jours pris
        $joursPris = Conge::where('id_employe', $employe->id_employe)
            ->where('statut', 'Validée')
            ->whereYear('date_debut', $annee)
            ->whereHas('typeConge', fn($q) => $q->where('decompte_solde', true))
            ->get()
            ->sum('nombre_jours');

        // Jours reportés de l'année précédente
        $joursReportes = self::where('id_employe', $employe->id_employe)
            ->where('annee', $annee - 1)
            ->value('jours_restants') ?? 0;

        return self::updateOrCreate(
            ['id_employe' => $employe->id_employe, 'annee' => $annee],
            [
                'jours_acquis' => $joursAcquis + $joursReportes,
                'jours_pris' => $joursPris,
                'jours_reportes' => $joursReportes,
                'date_calcul' => now(),
            ]
        );
    }
}

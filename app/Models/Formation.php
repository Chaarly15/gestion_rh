<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Formation extends Model
{

    protected $table = 'formations';
    protected $primaryKey = 'id_formation';

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'duree_heures',
        'formateur',
        'cout',
        'statut',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'duree_heures' => 'integer',
        'cout' => 'decimal:2',
    ];

    // Relations
    public function employes(): BelongsToMany
    {
        return $this->belongsToMany(Employe::class, 'employe_formations', 'id_formation', 'id_employe')
                    ->withPivot('statut', 'note', 'commentaire')
                    ->withTimestamps();
    }

    // Accesseurs
    public function getPlacesRestantesAttribute(): int
    {
        if (!$this->places_disponibles) {
            return 9999; // Illimité
        }
        
        return max(0, $this->places_disponibles - $this->employes()->count());
    }

    public function getIsCompleteAttribute(): bool
    {
        return $this->places_disponibles && $this->employes()->count() >= $this->places_disponibles;
    }

    public function getIsInscriptionOuverteAttribute(): bool
    {
        return $this->statut === 'planifiee' && !$this->is_complete;
    }

    public function getTauxParticipationAttribute(): float
    {
        if (!$this->places_disponibles) {
            return 0;
        }
        
        return round(($this->employes()->count() / $this->places_disponibles) * 100, 2);
    }

    // Scopes
    public function scopePlanifiees($query)
    {
        return $query->where('statut', 'planifiee');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }

    public function scopeTerminees($query)
    {
        return $query->where('statut', 'terminee');
    }

    public function scopeAVenir($query)
    {
        return $query->where('statut', 'planifiee')
                     ->where('date_debut', '>', now());
    }

    // Méthodes métier
    public function inscrire(Employe $employe, $statut = 'en cours')
    {
        if ($this->is_complete) {
            throw new \Exception('Formation complète');
        }

        $this->employes()->attach($employe->id_employe, [
            'date_inscription' => now(),
            'statut' => $statut,
        ]);
    }

    public function desinscrire(Employe $employe)
    {
        $this->employes()->detach($employe->id_employe);
    }

    public function marquerPresent(Employe $employe, $note = null)
    {
        $this->employes()->updateExistingPivot($employe->id_employe, [
            'statut' => 'terminée',
            'note' => $note,
        ]);
    }
}

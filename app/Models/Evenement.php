<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Evenement extends Model
{

    protected $table = 'evenements';
    protected $primaryKey = 'id_evenement';

    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'lieu',
        'statut',
        'organisateur_id',
        'id_type_evenement',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'heure_debut' => 'datetime:H:i',
        'heure_fin' => 'datetime:H:i',
    ];

    // Relations
    public function organisateur(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'organisateur_id', 'id_employe');
    }

    public function typeEvenement(): BelongsTo
    {
        return $this->belongsTo(TypeEvenement::class, 'id_type_evenement', 'id_type_evenement');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Employe::class, 'employe_evenements', 'id_evenement', 'id_employe')
                    ->withPivot('statut_participation', 'commentaire')
                    ->withTimestamps();
    }

    // Accesseurs
    public function getIsPasseAttribute(): bool
    {
        return $this->date_debut < now()->toDateString();
    }

    public function getIsEnCoursAttribute(): bool
    {
        return $this->date_debut <= now()->toDateString() &&
               $this->date_fin >= now()->toDateString();
    }

    // Scopes
    public function scopePlanifies($query)
    {
        return $query->where('statut', 'planifie');
    }

    public function scopeAVenir($query)
    {
        return $query->where('date_debut', '>=', now()->toDateString())
                     ->orderBy('date_debut');
    }

    public function scopeTermines($query)
    {
        return $query->where('statut', 'termine');
    }

    public function scopeEnCours($query)
    {
        return $query->where('statut', 'en_cours');
    }
}

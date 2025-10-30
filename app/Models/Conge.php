<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conge extends Model
{

    protected $table = 'conges';
    protected $primaryKey = 'id_conge';

    protected $fillable = [
        'date_debut',
        'date_fin',
        'libelle',
        'motif',
        'commentaire',
        'statut',
        'motif_rejet',
        'date_validation',
        'valideur_id',
        'id_employe',
        'id_type_conge',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_validation' => 'datetime',
    ];

    // Relations
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'id_employe', 'id_employe');
    }

    public function typeConge(): BelongsTo
    {
        return $this->belongsTo(TypeConge::class, 'id_type_conge', 'id_type_conge');
    }

    public function valideur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'valideur_id');
    }

    public function piecesJustificatives(): HasMany
    {
        return $this->hasMany(PieceJustificative::class, 'id_absence');
    }

    // Accesseurs
    public function getDureeAttribute(): string
    {
        if ($this->date_fin) {
            $diffInDays = $this->date_debut->diffInDays($this->date_fin);
            $diffInHours = $this->date_debut->diffInHours($this->date_fin) % 24;
            
            if ($diffInDays > 0) {
                return $diffInDays . ' jour(s)' . ($diffInHours > 0 ? ' et ' . $diffInHours . ' heure(s)' : '');
            }
            return $diffInHours . ' heure(s)';
        }
        
        return $this->duree_heures ? $this->duree_heures . ' heure(s)' : 'En cours';
    }

    public function getIsJustifieeAttribute(): bool
    {
        return $this->piecesJustificatives()->exists();
    }

    // Scopes
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeValidees($query)
    {
        return $query->where('statut', 'approuve');
    }

    public function scopeParType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeCeMois($query)
    {
        return $query->whereMonth('date_debut', now()->month)
                     ->whereYear('date_debut', now()->year);
    }

    // Méthodes métier
    public function valider($userId = null)
    {
        $this->update([
            'statut' => 'approuve',
            'date_validation' => now(),
            'valideur_id' => $userId,
        ]);
    }

    public function rejeter($userId = null)
    {
        $this->update([
            'statut' => 'rejete',
            'date_validation' => now(),
            'valideur_id' => $userId,
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';
    protected $primaryKey = 'id_absence';

    protected $fillable = [
        'id_employe',
        'date_debut',
        'date_fin',
        'jours_absence',
        'motif',
        'statut',
        'commentaire',
        'date_declaration'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'date_declaration' => 'datetime',
    ];

    // Relations
    public function employe(): BelongsTo
    {
        return $this->belongsTo(Employe::class, 'id_employe', 'id_employe');
    }

    public function piecesJustificatives(): HasMany
    {
        return $this->hasMany(PieceJustificative::class, 'id_absence', 'id_absence');
    }

    // Méthodes
    public function getDureeAttribute(): int
    {
        return $this->date_debut->diffInDays($this->date_fin) + 1;
    }

    public function isJustifiee(): bool
    {
        return $this->statut === 'justifiee';
    }

    public function isEnAttente(): bool
    {
        return $this->statut === 'en_attente';
    }
}

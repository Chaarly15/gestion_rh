<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeConge extends Model
{
    use HasFactory;
    
    protected $table = 'type_conges';
    protected $primaryKey = 'id_type_conge';

    protected $fillable = [
        'libelle',
        'jours_max',
        'description'
    ];

    protected $casts = [
        'jours_max' => 'integer',
    ];

    // Relations
    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class, 'id_type_conge');
    }

    // Accesseurs
    public function getJoursMaxFormatteAttribute(): string
    {
        return $this->jours_max ? $this->jours_max . ' jours' : 'Illimité';
    }

    public function getNomTypeCongeAttribute(): string
    {
        return $this->libelle;
    }
}

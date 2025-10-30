<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeEvenement extends Model
{
    use HasFactory;
    
    protected $table = 'type_evenements';
    protected $primaryKey = 'id_type_evenement';

    protected $fillable = [
        'nom',
        'description'
    ];

    // Relations
    public function evenements(): HasMany
    {
        return $this->hasMany(Evenement::class, 'id_type_evenement');
    }

    // Accesseurs
    public function getNomTypeEvenementAttribute(): string
    {
        return $this->nom;
    }
}
